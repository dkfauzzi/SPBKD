<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dekan;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;


class DekanController extends Controller
{
    public function index()
    {
        // Fetch user 
        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk')
        ->get();

        // Filter sekretariat 
        $data = $data->reject(function ($user) {
            return in_array($user->level, ['sekretariat', 'sekretariat2']);
        });

        $countNIPRows = QuarterDate::select('NIP')
        ->selectRaw('COUNT(*) as count_rows')
        ->groupBy('NIP')
        ->pluck('count_rows', 'NIP')
        ->toArray();

        // Hitung jumlah SK with specific NIP (per-dosen)
        $totalSKS = $data->groupBy('NIP')->map(function ($group) {
            return [
                'NIP' => $group->first()->NIP,
                'nama' => $group->first()->nama,
                'JAD' => $group->first()->JAD,
                'Prodi' => $group->first()->Prodi,
                'KK' => $group->first()->KK,
                'email' => $group->first()->email,
                'total_sk' => $group->count(), // Hitung SK row sesuai 'NIP'
                'total_sks' => $group->sum('sks'),
            ];
        });

        return view('dekan.dekan-search', compact('data','totalSKS','countNIPRows'));
    }

    public function create($NIP)
    {
        $user = User::where('NIP', $NIP)->first();

        return view('dekan.dekan-tambah-sk', compact('user','NIP'));

    }

    public function store(Request $request){

        // set data yang di store
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'sk'  => 'required',
            'sks'  => 'required',
            'jenis_sk'  => 'required',
            'keterangan_sk' => 'required',
            'NIP' => 'required',
        ]);

        $nip = $data['NIP'];

        $start_date = \Carbon\Carbon::parse($data['start_date']);
        $end_date = \Carbon\Carbon::parse($data['end_date']);

        // Set mulainya bulan dan tanggal TW. Contoh 1(1,1) = TW1 (bulan januari, tanngal 1)
        $quarterStarts = [
            1 => \Carbon\Carbon::createFromDate($start_date->year, 1, 1),
            2 => \Carbon\Carbon::createFromDate($start_date->year, 4, 1),
            3 => \Carbon\Carbon::createFromDate($start_date->year, 7, 1),
            4 => \Carbon\Carbon::createFromDate($start_date->year, 10, 1),
        ];

        // Set berakhirnya bulan dan tanggal TW. Contoh 1(3,31) = TW1(bulan maret, tanngal 31)
        $quarterEnds = [
            1 => \Carbon\Carbon::createFromDate($start_date->year, 3, 31),
            2 => \Carbon\Carbon::createFromDate($start_date->year, 6, 30),
            3 => \Carbon\Carbon::createFromDate($start_date->year, 9, 30),
            4 => \Carbon\Carbon::createFromDate($start_date->year, 12, 31),
        ];

        //Untuk tanggal
        $quartersData['NIP'] = $nip;

        //Untuk SK dan SKS dll.
        $quartersData['start_date'] = $data['start_date'];
        $quartersData['end_date'] = $data['end_date'];
        $quartersData['sks'] = $data['sks'];
        $quartersData['sk'] = $data['sk'];
        $quartersData['jenis_sk'] = $data['jenis_sk'];
        $quartersData['keterangan_sk'] = $data['keterangan_sk'];
        // $quartersData['NIP'] = $data['NIP'];



        //Loop untuk penentuan restriction tiap kolom Triwulan (tw1,tw2,tw3,tw4)
        for ($quarter = 1; $quarter <= 4; $quarter++) {
            $qStart = $quarterStarts[$quarter];
            $qEnd = $quarterEnds[$quarter];

            if ($end_date < $qStart || $start_date > $qEnd) {
                // Jika tanggal berada diluar TW, leave the columns empty
                $quartersData["q{$quarter}_start"] = null;
                $quartersData["q{$quarter}_end"] = null;
            } else {
                //Jika tanggal berada di dalam TW, insert into column
                $quartersData["q{$quarter}_start"] = max($start_date, $qStart);
                $quartersData["q{$quarter}_end"] = min($end_date, $qEnd);
            }
        }

        // $quartersData['start_sk'] = $start_date->format('Y-Q');
        $quartersData['start_sk'] = $start_date->year . '-Q' . ceil($start_date->month / 3);
        $quartersData['end_sk'] = $end_date->year . '-Q' . ceil($end_date->month / 3);


        QuarterDate::create($quartersData);

        // return redirect('sekretariat2-dosen-details');  
        return redirect()->route('dekan-dosen-details', ['NIP' => $request->input('NIP')]);


    }


    public function delete($NIP)
    {
        $data = QuarterDate::where('NIP', $NIP)->firstOrFail();

        // Delete the record
        $data->delete();

        return redirect()->back()->with('success', 'Record deleted successfully');
    }

    public function detailDosen($NIP)
    {
        
        // cari dosen dengan NIP
        $data = User::where('NIP', $NIP)->first();

        $imagePath = $data->image_path;

        // ambil data SK dengan NIP yang di pilih
        $test = QuarterDate::where('NIP', $NIP)->get(); 

        return view('dekan.dekan-dosen-details', compact('data','test'));
    }



    //CHARTS
    public function indexChart($year = null)
    {
        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
            ->get();
    
        // Filter data based on the selected year or the last two years if no year is provided
        if ($year) {
            $data = $data->filter(function ($item) use ($year) {
                $startDateYear = Carbon::parse($item->start_date)->year;
                $endDateYear = Carbon::parse($item->end_date)->year;
    
                return $startDateYear == $year || $endDateYear == $year || ($startDateYear < $year && $endDateYear > $year);
            });
        } else {
            $currentYear = Carbon::now()->year;
            $data = $data->filter(function ($item) use ($currentYear) {
                $startDateYear = Carbon::parse($item->start_date)->year;
                $endDateYear = Carbon::parse($item->end_date)->year;
    
                return $startDateYear == $currentYear || $endDateYear == $currentYear || ($startDateYear < $currentYear && $endDateYear > $currentYear);
            });
        }
    
        // Retrieve distinct years from your data
        $distinctYears = $data->flatMap(function ($item) {
            return [$item->start_date, $item->end_date];
        })->map(function ($date) {
            return Carbon::parse($date)->year;
        })->unique()->sort()->values()->toArray();
    
        return view('dekan.dekan-charts', compact('distinctYears'));
    }

    public function data_SK()
    {
        $data = QuarterDate::all();

        // Hitung SK Tiap Prodi
        $semuaProdi = User::pluck('Prodi')->toArray();
        $skProdi = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        // ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->select('users.Prodi', DB::raw('COALESCE(COUNT(test_sk_dosen.sk), 0) as count, COALESCE(SUM(test_sk_dosen.sks), 0) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $chartSKProdi = $skProdi->pluck('count', 'Prodi');
        $chartTotalSKProdi = $skProdi->pluck('total_sks', 'Prodi');


        // Hitung SK Tiap Kelompok Keahlian
        $semuaKK = User::pluck('KK')->toArray();
        $skKK = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
        ->select('users.KK', DB::raw('COUNT(test_sk_dosen.sk) as count'))
        ->groupBy('users.KK')
        ->get();
        $chartSKSKK = $skKK->pluck('count', 'KK');

        $semuaDosen = User::pluck('nama')->toArray();
        $skDosen = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
            ->select('users.nama', DB::raw('COUNT(test_sk_dosen.sk) as count'))
            ->groupBy('users.nama')
            ->get();
        $chartSKDosen = $skDosen->pluck('count', 'nama')->toArray();

        // LOOP agar dosen yang SKS nya 0 ikut terhitung
        foreach ($semuaDosen as $nama) {
            if (!array_key_exists($nama, $chartSKDosen)) {
                $chartSKDosen[$nama] = 0;
            }
        }

        return response()->json([
            'prodi_SK' => $chartSKProdi,
            'kk_SK' => $chartSKSKK,
            'dosen_SK' => $chartSKDosen,


        ]);

    }

    public function data_SKS()
    {
        $data = QuarterDate::all();

        // Hitung SKS Tiap Prodi
        $semuaProdi = User::pluck('Prodi')->toArray();
        $sksProdi = DB::table('users')
        // ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $chartSKSProdi = $sksProdi->pluck('count', 'Prodi');
        $chartTotalSKSProdi = $sksProdi->pluck('total_sks', 'Prodi');

        // Hitung SKS Tiap Kelompok Keahlian
        $semuaKK = User::pluck('KK')->toArray();
        $sksKK = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
            ->select('users.KK', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.KK')
            ->get();
        $chartSKSKK = $sksKK->pluck('total_sks','KK');


        // Hitung SKS Tiap Dosen
        $semuaDosen = User::pluck('nama')->toArray();
        $sksDosen = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
            ->select('users.nama', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.nama')
            ->get();
        $chartSKSDosen = $sksDosen->pluck('total_sks', 'nama')->toArray();

        // LOOP agar dosen yang SKS nya 0 ikut terhitung
        foreach ($semuaDosen as $nama) {
            if (!array_key_exists($nama, $chartSKSDosen)) {
                $chartSKSDosen[$nama] = 0;
            }
        }

        return response()->json([
            'prodi_sks' => $chartTotalSKSProdi,
            'kk_sks' => $chartSKSKK,
            'dosen_sks' => $chartSKSDosen,
        ]);

    }

    public function report($year = null) {

        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
        ->get();

        // Filter data based on the selected year or the last two years if no year is provided
        if ($year) {
            $data = $data->filter(function ($item) use ($year) {
                $startDateYear = Carbon::parse($item->start_date)->year;
                $endDateYear = Carbon::parse($item->end_date)->year;

                return $startDateYear == $year || $endDateYear == $year || ($startDateYear < $year && $endDateYear > $year);
            });
        } else {
            $currentYear = Carbon::now()->year;
            $data = $data->filter(function ($item) use ($currentYear) {
                $startDateYear = Carbon::parse($item->start_date)->year;
                $endDateYear = Carbon::parse($item->end_date)->year;

                return $startDateYear == $currentYear || $endDateYear == $currentYear || ($startDateYear < $currentYear && $endDateYear > $currentYear);
            });
        }

        // ========PRODI========
        $groupedDataProdi = $data->groupBy('Prodi')->map(function ($group) {
            return $group->groupBy(function ($item) {
                $startDate = Carbon::parse($item->start_date);
                return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
            });
        });
        
        $prodiData = collect();
        
        $groupedDataProdi->each(function ($groups, $Prodi) use ($prodiData) {
            $semester1Data = $groups->get('semester1', collect());
            $semester2Data = $groups->get('semester2', collect());
        
            $prodiData->push([
                'Prodi' => $Prodi,
                'semester1_sks' => intval($semester1Data->sum('sks')), 
                'semester2_sks' => intval($semester2Data->sum('sks')), 
                'total_sks' => intval($semester1Data->sum('sks')) + intval($semester2Data->sum('sks')), 
                'semester1_sk' => $semester1Data->pluck('sk')->unique()->count(),
                'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->unique()->count(),
                'total_sk' => $semester1Data->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->unique()->count(),
            ]);
            
        });
        


    
        // ========KELOMPOK KEAHLIAH========
        $groupedDataKK = $data->groupBy('KK')->map(function ($group) {
            return $group->groupBy(function ($item) {
                $startDate = Carbon::parse($item->start_date);
                return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
            });
        });
        
        $kkData = collect();
        
        $groupedDataKK->each(function ($groups, $KK) use ($kkData) {
            $semester1Data = $groups->get('semester1', collect());
            $semester2Data = $groups->get('semester2', collect());
        
            $kkData->push([
                'KK' => $KK,
                'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
                'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
                'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
                'semester1_sk' => $semester1Data->count(), // Count of SK for semester 1
                'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->unique()->count(),
                'total_sk' => $semester1Data->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->unique()->count()
            ]);
        });
        
        // ========DOSEN========
        $groupedDataDosen = $data->groupBy('NIP')->map(function ($group) {
            return $group->groupBy(function ($item) {
                $startDate = Carbon::parse($item->start_date);
                return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
            });
        });
        
        $dosenData = collect();
        
        $groupedDataDosen->each(function ($groups, $NIP) use ($dosenData) {
            $semester1Data = $groups->get('semester1', collect());
            $semester2Data = $groups->get('semester2', collect());
        
            $dosenData->push([
                'NIP' => $NIP,
                'nama' => $groups->first()->first()->nama ?? '',
                'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
                'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
                'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
                'semester1_sk' => $semester1Data->count(), // Count of SK for semester 1
                'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->unique()->count(),
                'total_sk' => $semester1Data->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->unique()->count()
            ]);
        });
        
        
        $pdf = PDF::loadView('dekan.dekan-print-report', compact('dosenData', 'prodiData', 'kkData', 'year'));

        return $pdf->stream();

    }







    // PROFILE

    public function indexProfile()
    {
        $user = Auth::user()->NIP;

        $userDosen = User::where('NIP', '=', $user)->first();

        $imagePath = $userDosen->image_path;

        $dataDosen = QuarterDate::where('NIP', '=', $user)->get();

        return view('dekan.profile', compact('user', 'userDosen', 'dataDosen'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'NIP' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'image' => 'nullable|image',
        ]);
        
        $user = Auth::user();
        
        if ($request->hasFile('image')) {
            // Delete existing image (if any)
            if ($user->image_path) {
                Storage::delete($user->image_path);
            }

            // Upload new image to the public/profile_image directory
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile_image', $imageName, 'public');

        
            $data['image_path'] = 'profile_image/' . $imageName;
        }
        
        $user->update($data);
        
        return redirect()->route('profile')->with('success', 'User updated successfully');
        
    }

}