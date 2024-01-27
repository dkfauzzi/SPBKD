<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Exports\exportReport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportReport implements FromCollection, WithHeadings
{
    
    
    // public function sheets(): array
    // {
    //     $sheets = [];

    //     $sheets[] = new SheetDosen($this->dosenData);

    //     // $sheets[] = new AnotherTableSheet($this->anotherTableData);

    //     return $sheets;
    // }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Semester 1 SKS',
            'Semester 2 SKS',
            'Total SKS',
            'Semester 1 SK',
            'Semester 2 SK',
            'Total SK',
        ];
    }

    public function collection()
    {
        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
                ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date', 'test_sk_dosen.end_date')
                ->get();

            // Exclude users with specific levels
            $data = $data->reject(function ($user) {
                return in_array($user->level, ['sekretariat', 'sekretariat2']);
            });

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
                'semester1_sks' => $semester1Data->sum('sks') ?? 0,
                'semester2_sks' => $semester2Data->sum('sks') ?? 0,
                'total_sks' => ($semester1Data->sum('sks') ?? 0) + ($semester2Data->sum('sks') ?? 0),
                'semester1_sk' => $semester1Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->count() ?? 0,
                'semester2_sk' => $semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->count() ?? 0,
                'total_sk' => ($semester1Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->count() ?? 0) + ($semester2Data->pluck('sk')->reject(function ($value) {
                    return empty($value);
                })->count() ?? 0)
            ]);
        });

        return $dosenData;
    }

}


