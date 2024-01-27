<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SheetDosen implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

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
