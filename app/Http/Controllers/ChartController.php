<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class ChartController extends Controller
{
    public function index($year = null)
    {
        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date')
        ->get();

        // Filter data based on the selected year if a year is provided
        if ($year) {
            $data = $data->filter(function ($item) use ($year) {
                return Carbon::parse($item->start_date)->year == $year;
            });
        }
        // Retrieve distinct years from your data
        $distinctYears = $data->map(function ($item) {
            return Carbon::parse($item->start_date)->year;
        })->unique()->sort()->values()->toArray();

        return view('sekretariat2.sekretariat2-charts', compact('distinctYears'));
    }

    
    public function report($year = null) {

        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date')
        ->get();

        if ($year) {
            $data = $data->filter(function ($item) use ($year) {
                return Carbon::parse($item->start_date)->year == $year;
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
                'semester1_sks' => intval($semester1Data->sum('sks')), // Cast to integer
                'semester2_sks' => intval($semester2Data->sum('sks')), // Cast to integer
                'total_sks' => intval($semester1Data->sum('sks')) + intval($semester2Data->sum('sks')), // Cast to integer
                'semester1_sk' => $semester1Data->count(),
                'semester2_sk' => $semester2Data->count(),
                'total_sk' => $semester1Data->count() + $semester2Data->count(),
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
                'semester2_sk' => $semester2Data->count(), // Count of SK for semester 2
                'total_sk' => $semester1Data->count() + $semester2Data->count(), // Total SK for both semesters
            ]);
        });
        
        // ========DOSEN========
        $groupedDataDosen = $data->groupBy('NIP')->map(function ($group) {
            return $group->groupBy(function ($item) {
                $startDate = Carbon::parse($item->start_date);
                return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
            });
        });
        
        // Prepare data for the table
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
                'semester2_sk' => $semester2Data->count(), // Count of SK for semester 2
                'total_sk' => $semester1Data->count() + $semester2Data->count(), // Total SK for both semesters
            ]);
        });
        
        
        $pdf = PDF::loadView('sekretariat2.print-report', compact('dosenData', 'prodiData', 'kkData', 'year'));

        return $pdf->stream();

    }

    public function getDataSK()
    {
        $data = QuarterDate::all();

        // Hitung SK Tiap Prodi
        $skProdi = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $chartSKProdi = $skProdi->pluck('count', 'Prodi');
        $chartTotalSKProdi = $skProdi->pluck('total_sks', 'Prodi');


        // Hitung SK Tiap Kelompok Keahlian
        $semuaKK = User::pluck('KK')->toArray();
        $skKK = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
        ->select('users.KK', DB::raw('COUNT(*) as count'))
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

    public function getDataSKS()
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

        // foreach ($semuaKK as $KK) {
        //     if (!array_key_exists($KK, $chartSKSKK)) {
        //         $chartSKSKK[$kk] = 0;
        //     }
        // }

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


    // public function getDataSKSemester()
    // {
    // $data = QuarterDate::all();

    // // Determine the semester for each record
    // $data->each(function ($item) {
    //     $semester = Carbon::parse($item->start_date)->month <= 6 ? 'semester1' : 'semester2';
    //     $item->semester = $semester;
    // });

    // $dataSemester1 = $data->where('semester', 'semester1');
    // $dataSemester2 = $data->where('semester', 'semester2');

    // // Hitung SK Tiap Prodi for Semester 1
    // $skProdiSemester1 = DB::table('test_sk_dosen')
    //     ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
    //     ->where(function ($query) {
    //         // Adjust the date range for Semester 1 (January to June)
    //         $query->whereMonth('test_sk_dosen.start_date', '>=', 1)
    //             ->whereMonth('test_sk_dosen.start_date', '<=', 6);
    //     })
    //     ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
    //     ->groupBy('users.Prodi')
    //     ->get();

    // $chartSKProdiSemester1 = $skProdiSemester1->pluck('count', 'Prodi');
    // $chartTotalSKProdiSemester1 = $skProdiSemester1->pluck('total_sks', 'Prodi');


    // // Hitung SK Tiap Kelompok Keahlian for Semester 1
    // $skKKSemester1 = DB::table('test_sk_dosen')
    //     ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
    //     ->whereBetween('test_sk_dosen.start_date', ['start_semester1', 'end_semester1'])
    //     ->select('users.KK', DB::raw('COUNT(*) as count'))
    //     ->groupBy('users.KK')
    //     ->get();
    // $chartSKSKKSemester1 = $skKKSemester1->pluck('count', 'KK');

    // // Hitung SKS Tiap Dosen for Semester 1
    // $semuaDosen = User::pluck('nama')->toArray();
    // $skDosenSemester1 = DB::table('users')
    //     ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
    //     ->whereBetween('test_sk_dosen.start_date', ['start_semester1', 'end_semester1'])
    //     ->select('users.nama', DB::raw('COUNT(test_sk_dosen.sk) as count'))
    //     ->groupBy('users.nama')
    //     ->get();
    // $chartSKDosenSemester1 = $skDosenSemester1->pluck('count', 'nama')->toArray();

    // // LOOP agar dosen yang SKS nya 0 ikut terhitung
    // foreach ($semuaDosen as $nama) {
    //     if (!array_key_exists($nama, $chartSKDosenSemester1)) {
    //         $chartSKDosenSemester1[$nama] = 0;
    //     }
    // }

    // // Repeat the above logic for Semester 2 with appropriate variable names

    // return response()->json([
    //     'prodi_SK_semester1' => $chartSKProdiSemester1,
    //     'kk_SK_semester1' => $chartSKSKKSemester1,
    //     'dosen_SK_semester1' => $chartSKDosenSemester1,
    //     // 'prodi_SK_semester2' => $chartSKProdiSemester2,
    //     // 'kk_SK_semester2' => $chartSKSKKSemester2,
    //     // 'dosen_SK_semester2' => $chartSKDosenSemester2,
    // ]);


    public function getDataSKSemester()
{
    // Fetch data for Semester 1 (January to June)
    $semester1Data = QuarterDate::whereBetween('start_date', ['2023-01-01', '2023-06-30'])->get();

    // Fetch data for Semester 2 (July to December)
    $semester2Data = QuarterDate::whereBetween('start_date', ['2023-07-01', '2023-12-31'])->get();

    dd($semester1Data);
    // Hitung SK Tiap Prodi
    $skProdi = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
    $chartSKProdi = $skProdi->pluck('count', 'Prodi');
    $chartTotalSKProdi = $skProdi->pluck('total_sks', 'Prodi');

    // Hitung SK Tiap Kelompok Keahlian
    $skKK = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.KK', DB::raw('COUNT(*) as count'))
        ->groupBy('users.KK')
        ->get();
    $chartSKSKK = $skKK->pluck('count', 'KK');

    // Hitung SKS Tiap Dosen
    $semuaDosen = User::pluck('nama')->toArray();
    $skDosen = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
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
        'semester1Data' => $semester1Data,
        'semester2Data' => $semester2Data,
    ]);
}

}






