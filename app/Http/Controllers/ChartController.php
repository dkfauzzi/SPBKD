<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exports\exportReport;
use Maatwebsite\Excel\Facades\Excel;


class ChartController extends Controller
{

    public function index($year = null)
    {
        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
            ->get();
    
       // Retrieve distinct years from your data
        $distinctYears = $data->flatMap(function ($item) {
            return range(Carbon::parse($item->start_date)->year, Carbon::parse($item->end_date)->year);
        })->unique()->sort()->values()->toArray();

        // Use the selected year for filtering if provided
        if ($year) {
            $data = $data->filter(function ($item) use ($year) {
                $startDateYear = Carbon::parse($item->start_date)->year;
                $endDateYear = Carbon::parse($item->end_date)->year;
                return $startDateYear <= $year && $endDateYear >= $year;
            });
        }

        // Fetch all users and their related SK information
        $tableDosen = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->leftJoin('sk_undangan', 'users.NIP', '=', 'sk_undangan.NIP')
        ->select(
            'users.*',
            'test_sk_dosen.sk as test_sk_dosen_sk',
            'test_sk_dosen.sks as test_sk_dosen_sks',
            'sk_undangan.sks as sk_undangan_sks'
        )
        ->get();

        // Filter sekretariat 
        $tableDosen = $tableDosen->reject(function ($user) {
            return in_array($user->level, ['sekretariat', 'sekretariat2']);
        });

        $countNIPRows = QuarterDate::select('NIP')
        ->selectRaw('COUNT(*) as count_rows')
        ->groupBy('NIP')
        ->pluck('count_rows', 'NIP')
        ->toArray();

        // Hitung jumlah SK with specific NIP (per-dosen)
        $totalSKS = $tableDosen->groupBy('NIP')->map(function ($group) {
            return [
                'NIP' => $group->first()->NIP,
                'nama' => $group->first()->nama,
                'JAD' => $group->first()->JAD,
                'Prodi' => $group->first()->Prodi,
                'KK' => $group->first()->KK,
                'email' => $group->first()->email,
                'total_sk' => $group->count(), // Count of rows with the same 'NIP'
                'total_sks' => $group->pluck('test_sk_dosen_sks')->unique()->sum(),
                'total_sks_undangan' => $group->pluck('sk_undangan_sks')->unique()->sum(),
            ];
        });
 
    
        return view('sekretariat2.sekretariat2-charts', compact('distinctYears','tableDosen','totalSKS','countNIPRows'));
    }


    
    // public function report($year = null) {

    //     $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
    //     ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
    //     ->get();

    //     try {
    //         // Retrieve data from the database
    //         $data = $this->getData($year);

    //         // Aggregate data for Prodi, KK, and Dosen
    //         $prodiData = $this->aggregateData($data, 'Prodi');
    //         $kkData = $this->aggregateData($data, 'KK');
    //         $dosenData = $this->aggregateData($data, 'NIP');

    //         // Pass the image path to the view
    //         $logoPath = public_path('assets_index/assets/img/logo-fri-hijau.png');

    //         // Use the compact function to pass variables to the view
    //         $pdf = PDF::loadView('sekretariat2.print-report', compact('dosenData', 'prodiData', 'kkData', 'year', 'logoPath'));

    //         // Stream the PDF for download or display
    //         return $pdf->stream();
    //     } catch (\Exception $e) {
    //         // Handle exceptions, log errors, or return an appropriate response
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }

    //     // Filter data based on the selected year or the last two years if no year is provided
    //     if ($year) {
    //         $data = $data->filter(function ($item) use ($year) {
    //             $startDateYear = Carbon::parse($item->start_date)->year;
    //             $endDateYear = Carbon::parse($item->end_date)->year;
        
    //             // Check if the range overlaps with the given year
    //             return ($startDateYear <= $year && $endDateYear >= $year);
    //         });
    //     } else {
    //         $currentYear = Carbon::now()->year;
    //         $data = $data->filter(function ($item) use ($currentYear) {
    //             $startDateYear = Carbon::parse($item->start_date)->year;
    //             $endDateYear = Carbon::parse($item->end_date)->year;

    //             return $startDateYear == $currentYear || $endDateYear == $currentYear || ($startDateYear < $currentYear && $endDateYear > $currentYear);
    //         });
    //     }

    //     // ========PRODI========
    //     $groupedDataProdi = $data->groupBy('Prodi')->map(function ($group) {
    //         return $group->groupBy(function ($item) {
    //             $startDate = Carbon::parse($item->start_date);
    //             return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
    //         });
    //     });
        
    //     $prodiData = collect();
        
    //     $groupedDataProdi->each(function ($groups, $Prodi) use ($prodiData) {
    //         $semester1Data = $groups->get('semester1', collect());
    //         $semester2Data = $groups->get('semester2', collect());
        
    //         $prodiData->push([
    //             'Prodi' => $Prodi,
    //             'semester1_sks' => $semester1Data->sum('sks'), 
    //             'semester2_sks' => $semester2Data->sum('sks'), 
    //             'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), 
    //             'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(),
    //             'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(),
    //             'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(),+ $semester2Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(),
    //         ]);
            
    //     });
        
    //     // ========KELOMPOK KEAHLIAH========
    //     $groupedDataKK = $data->groupBy('KK')->map(function ($group) {
    //         return $group->groupBy(function ($item) {
    //             $startDate = Carbon::parse($item->start_date);
    //             return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
    //         });
    //     });
        
    //     $kkData = collect();
        
    //     $groupedDataKK->each(function ($groups, $KK) use ($kkData) {
    //         $semester1Data = $groups->get('semester1', collect());
    //         $semester2Data = $groups->get('semester2', collect());
        
    //         $kkData->push([
    //             'KK' => $KK,
    //             'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
    //             'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
    //             'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
    //             'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(), // Count of SK for semester 1
    //             'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(),
    //             'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count() + $semester2Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count()
    //         ]);
    //     });
        
    //     // ========DOSEN========
    //     $groupedDataDosen = $data->groupBy('NIP')->map(function ($group) {
    //         return $group->groupBy(function ($item) {
    //             $startDate = Carbon::parse($item->start_date);
    //             return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
    //         });
    //     });
        
    //     $dosenData = collect();
        
    //     $groupedDataDosen->each(function ($groups, $NIP) use ($dosenData) {
    //         $semester1Data = $groups->get('semester1', collect());
    //         $semester2Data = $groups->get('semester2', collect());
        
    //         $dosenData->push([
    //             'NIP' => $NIP,
    //             'nama' => $groups->first()->first()->nama ?? '',
    //             'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
    //             'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
    //             'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
    //             'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(), // Count of SK for semester 1
    //             'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(),
    //             'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count(), + $semester2Data->pluck('sk')->reject(function ($value) {
    //                 return empty($value);
    //             })->unique()->count()
    //         ]);
    //     });
        
        
    //     $pdf = PDF::loadView('sekretariat2.print-report', compact('dosenData', 'prodiData', 'kkData', 'year'));

    //     return $pdf->stream();

    // }

    public function report($year = null) 
    {
        try {
            // Retrieve data from the database
            $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
                ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
                ->get();

            // Exclude users with specific levels
            $data = $data->reject(function ($user) {
                return in_array($user->level, ['sekretariat', 'sekretariat2']);
            });

            // Filter data based on the selected year or the last two years if no year is provided
            if ($year) {
                $data = $data->filter(function ($item) use ($year) {
                    $startDateYear = Carbon::parse($item->start_date)->year;
                    $endDateYear = Carbon::parse($item->end_date)->year;

                    // Check if the range overlaps with the given year
                    return ($startDateYear <= $year && $endDateYear >= $year);
                });
            } else {
                $currentYear = Carbon::now()->year;
                $data = $data->filter(function ($item) use ($currentYear) {
                    $startDateYear = Carbon::parse($item->start_date)->year;
                    $endDateYear = Carbon::parse($item->end_date)->year;

                    return $startDateYear == $currentYear || $endDateYear == $currentYear || ($startDateYear < $currentYear && $endDateYear > $currentYear);
                });
            }


            // ========Kegiatan SK========
            $groupedDataSK = $data->groupBy('sk')->map(function ($group) {
                return $group->groupBy(function ($item) {
                    $startDate = Carbon::parse($item->start_date);
                    return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
                });
            });
            
            $skData = collect();
            
            $groupedDataSK->each(function ($groups, $SK) use ($skData) {
                $semester1Data = $groups->get('semester1', collect());
                $semester2Data = $groups->get('semester2', collect());
            
                $skData->push([
                    'sk' => $SK,
                    'semester1_sks' => $semester1Data->sum('sks'), 
                    'semester2_sks' => $semester2Data->sum('sks'), 
                    'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), 
                    'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                    'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                    'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                ]);
                
            });

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
                    'semester1_sks' => $semester1Data->sum('sks'), 
                    'semester2_sks' => $semester2Data->sum('sks'), 
                    'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), 
                    'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                    'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                    'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
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
                    'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(), // Count of SK for semester 1
                    'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                    'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count()
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
                    'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(), // Count of SK for semester 1
                    'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count(),
                    'total_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count() + $semester2Data->pluck('sk')->reject(function ($value) {
                        return empty($value);
                    })->count()
                ]);
            });

            // Pass the image path to the view
            $logoFakultas = public_path('assets_index/assets/img/logo-fri-hijau-comp.png');
            $logoTelkom = public_path('assets_index/assets/img/logo-telkom-comp.png');


            // Use the compact function to pass variables to the view
            $pdf = PDF::loadView('sekretariat2.print-report', compact('dosenData', 'prodiData', 'kkData', 'skData', 'year', 'logoTelkom','logoFakultas'));

            // Stream the PDF for download or display
            return $pdf->stream();
        } catch (\Exception $e) {
            // Handle exceptions, log errors, or return an appropriate response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function exportToExcel($year = null)
    {
        try {
            // Retrieve data from the database
            $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
                ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
                ->get();
    
            // Exclude users with specific levels
            $data = $data->reject(function ($user) {
                return in_array($user->level, ['sekretariat', 'sekretariat2']);
            });
    
            // Filter data based on the selected year or the last two years if no year is provided
            if ($year) {
                $data = $data->filter(function ($item) use ($year) {
                    $startDateYear = Carbon::parse($item->start_date)->year;
                    $endDateYear = Carbon::parse($item->end_date)->year;
                    return ($startDateYear <= $year && $endDateYear >= $year);
                });
            } else {
                $currentYear = Carbon::now()->year;
                $data = $data->filter(function ($item) use ($currentYear) {
                    $startDateYear = Carbon::parse($item->start_date)->year;
                    $endDateYear = Carbon::parse($item->end_date)->year;
                    return $startDateYear == $currentYear || $endDateYear == $currentYear || ($startDateYear < $currentYear && $endDateYear > $currentYear);
                });
            }
    
            // Use the export class to create an Excel file
            return Excel::download(new exportReport($data), 'excel_report_tahun_' . $year . '.xlsx');
        } catch (\Exception $e) {
            // Handle exceptions, log errors, or return an appropriate response
            return response()->json(['error' => $e->getMessage()], 500);
        }
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


    public function SK_Prodi_Semester()
    {
        $data = QuarterDate::all();
    
        // Define date ranges for Semester 1 and Semester 2
        $semester1StartDate = '2023-01-01';
        $semester1EndDate = '2023-06-30';
        $semester2StartDate = '2023-07-01';
        $semester2EndDate = '2023-12-31';
    
        // Hitung SK Tiap Prodi for Semester 1
        $skProdiSemester1 = $this->get_SK_Prodi_Semester($semester1StartDate, $semester1EndDate);
    
        // Hitung SK Tiap Prodi for Semester 2
        $skProdiSemester2 = $this->get_SK_Prodi_Semester($semester2StartDate, $semester2EndDate);
    
        // Combine SK counts for each Prodi for both semesters
        $chartSKProdi = [
            'Semester 1' => $skProdiSemester1->pluck('count', 'jenis_sk')->toArray(),
            'Semester 2' => $skProdiSemester2->pluck('count', 'jenis_sk')->toArray(),
            'Combined' => [],
        ];
    
        // Get a list of all 'Prodi'
        $allProdi = QuarterDate::pluck('jenis_sk')->toArray();
    
        // Initialize counts for missing 'Prodi' to zero for both semesters
        foreach ($allProdi as $prodi) {
            if (!isset($chartSKProdi['Semester 1'][$prodi])) {
                $chartSKProdi['Semester 1'][$prodi] = 0;
            }
    
            if (!isset($chartSKProdi['Semester 2'][$prodi])) {
                $chartSKProdi['Semester 2'][$prodi] = 0;
            }
        }
    
        // Populate the 'Combined' array
        foreach ($skProdiSemester1 as $item) {
            $prodiKey = $item->Prodi;
            $chartSKProdi['Combined'][$prodiKey]['Semester 1'] = $item->count;
            $chartSKProdi['Combined'][$prodiKey]['Semester 2'] = 0; // Initialize Semester 2 count to 0
        }
    
        foreach ($skProdiSemester2 as $item) {
            $prodiKey = $item->Prodi;
    
            if (!isset($chartSKProdi['Combined'][$prodiKey])) {
                $chartSKProdi['Combined'][$prodiKey]['Semester 1'] = 0;
            }
    
            $chartSKProdi['Combined'][$prodiKey]['Semester 2'] = $item->count;
        }
    
        // Hitung SK Tiap Kelompok Keahlian
        $skKK = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->where(function($query) use ($semester1StartDate, $semester2EndDate) {
                $query->whereBetween('test_sk_dosen.start_date', [$semester1StartDate, $semester2EndDate]);
            })
            ->select('users.KK', DB::raw('COUNT(*) as count'))
            ->groupBy('users.KK')
            ->get();
        $chartSKSKK = $skKK->pluck('count', 'KK');
    
        // Other SK calculations as needed
    
        return response()->json([
            'prodi_SK' => $chartSKProdi,
            'kk_SK' => $chartSKSKK,
            // Add other SK data as needed
        ]);
    }
    
    private function get_SK_Prodi_Semester($startDate, $endDate) {
        return DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->whereBetween('test_sk_dosen.start_date', [$startDate, $endDate])
            ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.Prodi')
            ->get();
    }
    
    public function SK_KK_Semester()
    {
        // Fetch data from the database
        $data = QuarterDate::all();
    
        // Organize data by jenis_sk and year
        $chartData = $this->organizeData($data);
    
        // Pass the data to the view or return it as needed
        return response()->json(['kk_SK' => $chartData]);
    }
    
    private function organizeData($data)
    {
        $organizedData = [];
    
        foreach ($data as $item) {
            $year = Carbon::parse($item->start_date)->format('Y');
            $jenisSK = $item->jenis_sk;
    
            // If the jenis_SK is not set in the organized data, initialize it
            if (!isset($organizedData[$jenisSK])) {
                $organizedData[$jenisSK] = [];
            }
    
            // If the year is not set for the jenis_SK, initialize it
            if (!isset($organizedData[$jenisSK][$year])) {
                $organizedData[$jenisSK][$year] = 0;
            }
    
            // Increment the count for the jenis_SK for the year
            $organizedData[$jenisSK][$year]++;
        }
    
        return $organizedData;
    }


    public function PieChart($year = null)
    {
        // Fetch data from the database
        $data = $year
            ? QuarterDate::whereYear('start_date', '<=', $year)
                ->whereYear('end_date', '>=', $year)
                ->get()
            : QuarterDate::all();

        // Filter data for the specific year if a year is selected
        if ($year) {
            $data = $data->filter(function ($item) use ($year) {
                $startDateYear = Carbon::parse($item->start_date)->year;
                $endDateYear = Carbon::parse($item->end_date)->year;

                return $startDateYear <= $year && $endDateYear >= $year;
            });
        }

        // Organize data by 'sk'
        $chartData = $this->organizePieData($data);

        // Retrieve distinct years from your data
        $yearPie = $data->flatMap(function ($item) {
            return [$item->start_date, $item->end_date];
        })->map(function ($date) {
            return Carbon::parse($date)->year;
        })->unique()->sort()->values()->toArray();

        // Pass the data to the view or return it as needed
        return response()->json(['sk_data' => $chartData, 'yearPie' => $yearPie]);
    }


    private function organizePieData($data)
    {
        $organizedData = [];

        foreach ($data as $item) {
            $skValue = $item->sk;

            // If the 'sk' value is not set in the organized data, initialize it
            if (!isset($organizedData[$skValue])) {
                $organizedData[$skValue] = 0;
            }

            // Increment the count for the 'sk' value
            $organizedData[$skValue]++;
        }

        return $organizedData;
    }

    const QUARTERS = ['q1', 'q2', 'q3', 'q4'];

    public function QuarterlyLineChart($year = null)
    {
        // Fetch data from the database
        $data = $year
            ? QuarterDate::whereYear('start_date', '<=', $year)
                ->whereYear('end_date', '>=', $year)
                ->get()
            : QuarterDate::all();
    
        // Organize data by year and quarter
        $chartData = $this->organizeQuarterlyData($data, $year);
    
        // Retrieve distinct years from your data
        $distinctYears = $data->flatMap(function ($item) {
            return [$item->start_date, $item->end_date];
        })->map(function ($date) {
            return Carbon::parse($date)->year;
        })->unique()->sort()->values()->toArray();
    
        // Pass the data to the view or return it as needed
        return response()->json(['quarterlyChartData' => $chartData, 'distinct_years' => $distinctYears]);
    }
    
    
    private function organizeQuarterlyData($data, $selectedYear = null)
    {
        $organizedData = [];
    
        foreach ($data as $item) {
            // Extract the year from start and end dates using Carbon
            $startDateYear = Carbon::parse($item->start_date)->year;
            $endDateYear = Carbon::parse($item->end_date)->year;
    
            // Check if the selected year is within the range
            if ($selectedYear === null || ($selectedYear >= $startDateYear && $selectedYear <= $endDateYear)) {
                $year = $selectedYear ?? $startDateYear;
    
                // Initialize all quarters for the year if not already set
                if (!isset($organizedData[$year])) {
                    $organizedData[$year] = [
                        'q1' => 0,
                        'q2' => 0,
                        'q3' => 0,
                        'q4' => 0,
                    ];
                }
    
                foreach (self::QUARTERS as $quarter) {
                    $quarterFieldStart = $quarter . '_start';
                    $quarterFieldEnd = $quarter . '_end';
    
                    // Check if the quarter field is not set, initialize it
                    if (!isset($item->$quarterFieldStart) || !isset($item->$quarterFieldEnd)) {
                        continue; // Skip if quarter fields are not set
                    }
    
                    // Check if the item's start date falls within the quarter
                    if (Carbon::parse($item->$quarterFieldStart)->quarter == intval(substr($quarter, 1))) {
                        $organizedData[$year][$quarter]++;
                    }
                }
            }
        }
    
        // Flatten the data to ensure unique years
        $flattenedData = [];
        foreach ($organizedData as $year => $quarterData) {
            foreach ($quarterData as $quarter => $count) {
                $flattenedData['Q' . substr($quarter, 1) . '-' . $year ] = $count;
            }
        }
    
        return $flattenedData;
    }
    
    

    

    
    

    public function SKS_Prodi_Semester()
    {
        $data = QuarterDate::all();
     
        // Define date ranges for Semester 1 and Semester 2
        $semester1StartDate = '2023-01-01';
        $semester1EndDate = '2023-06-30';
        $semester2StartDate = '2023-07-01';
        $semester2EndDate = '2023-12-31';
    
        // Hitung SK Tiap Prodi for Semester 1
        $skProdiSemester1 = $this->get_SK_Prodi_Semester($semester1StartDate, $semester1EndDate);
    
        // Hitung SK Tiap Prodi for Semester 2
        $skProdiSemester2 = $this->get_SK_Prodi_Semester($semester2StartDate, $semester2EndDate);
    
        // Combine SK counts for each Prodi for both semesters
        $chartSKProdi = [
            'Semester 1' => $skProdiSemester1->pluck('total_sks', 'Prodi')->toArray(),
            'Semester 2' => $skProdiSemester2->pluck('total_sks', 'Prodi')->toArray(),
            'Combined' => [],
        ];
    
        // Get a list of all 'Prodi'
        $allProdi = User::pluck('Prodi')->toArray();
    
        // Initialize counts for missing 'Prodi' to zero for both semesters
        foreach ($allProdi as $prodi) {
            if (!isset($chartSKProdi['Semester 1'][$prodi])) {
                $chartSKProdi['Semester 1'][$prodi] = 0;
            }
    
            if (!isset($chartSKProdi['Semester 2'][$prodi])) {
                $chartSKProdi['Semester 2'][$prodi] = 0;
            }
        }
    
        // Populate the 'Combined' array
        foreach ($skProdiSemester1 as $item) {
            $prodiKey = $item->Prodi;
            $chartSKProdi['Combined'][$prodiKey]['Semester 1'] = $item->total_sks;
            $chartSKProdi['Combined'][$prodiKey]['Semester 2'] = 0; // Initialize Semester 2 count to 0
        }
    
        foreach ($skProdiSemester2 as $item) {
            $prodiKey = $item->Prodi;
    
            if (!isset($chartSKProdi['Combined'][$prodiKey])) {
                $chartSKProdi['Combined'][$prodiKey]['Semester 1'] = 0;
            }
    
            $chartSKProdi['Combined'][$prodiKey]['Semester 2'] = $item->total_sks;
        }
    
        // Hitung SK Tiap Kelompok Keahlian
        $skKK = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->where(function($query) use ($semester1StartDate, $semester2EndDate) {
                $query->whereBetween('test_sk_dosen.start_date', [$semester1StartDate, $semester2EndDate]);
            })
            ->select('users.KK', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.KK')
            ->get();
        $chartSKSKK = $skKK->pluck('total_sks', 'KK');
    
        // Other SK calculations as needed
    
        return response()->json([
            'prodi_SK' => $chartSKProdi,
            // Add other SK data as needed
        ]);
    }
    
    private function get_SKS_Prodi_Semester($startDate, $endDate) {
        return DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->whereBetween('test_sk_dosen.start_date', [$startDate, $endDate])
            ->select('users.Prodi', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.Prodi')
            ->get();
    }
    
    public function SKS_KK_Semester()
    {
        $data = QuarterDate::all();
    
        // Define date ranges for Semester 1 and Semester 2
        $semester1StartDate = '2023-01-01';
        $semester1EndDate = '2023-06-30';
        $semester2StartDate = '2023-07-01';
        $semester2EndDate = '2023-12-31';
    
        // Hitung SK Tiap KK for Semester 1
        $skKKSemester1 = $this->get_SK_KK_Semester($semester1StartDate, $semester1EndDate, 'KK');
    
        // Hitung SK Tiap KK for Semester 2
        $skKKSemester2 = $this->get_SK_KK_Semester($semester2StartDate, $semester2EndDate, 'KK');
    
        // Combine SK counts for each KK for both semesters
        $chartSKKK = [
            'Semester 1' => $skKKSemester1->pluck('total_sks', 'KK')->toArray(),
            'Semester 2' => $skKKSemester2->pluck('total_sks', 'KK')->toArray(),
            'Combined' => [],
        ];
    
        // Get a list of all 'KK'
        $allKK = User::pluck('KK')->toArray();
    
        // Initialize counts for missing 'KK' to zero for both semesters
        foreach ($allKK as $kk) {
            if (!isset($chartSKKK['Semester 1'][$kk])) {
                $chartSKKK['Semester 1'][$kk] = 0;
            }
    
            if (!isset($chartSKKK['Semester 2'][$kk])) {
                $chartSKKK['Semester 2'][$kk] = 0;
            }
        }
    
        // Populate the 'Combined' array
        foreach ($skKKSemester1 as $item) {
            $kkKey = $item->KK;
            $chartSKKK['Combined'][$kkKey]['Semester 1'] = $item->total_sks;
            $chartSKKK['Combined'][$kkKey]['Semester 2'] = 0; // Initialize Semester 2 count to 0
        }
    
        foreach ($skKKSemester2 as $item) {
            $kkKey = $item->KK;
    
            if (!isset($chartSKKK['Combined'][$kkKey])) {
                $chartSKKK['Combined'][$kkKey]['Semester 1'] = 0;
            }
    
            $chartSKKK['Combined'][$kkKey]['Semester 2'] = $item->total_sks;
        }
    
        // Other SK calculations as needed
    
        return response()->json([
            'kk_SK' => $chartSKKK,
            // Add other SK data as needed
        ]);
    }
    
    private function get_SKS_KK_Semester($startDate, $endDate) {
        return DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
            ->whereBetween('test_sk_dosen.start_date', [$startDate, $endDate])
            ->select("users.{$groupField}", DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy("users.{$groupField}")
            ->get();
    }
    
  
}










