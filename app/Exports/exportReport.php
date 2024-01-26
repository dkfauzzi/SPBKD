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
    /**
    * @return \Illuminate\Support\Collection
    */
   
    private $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Process your data as needed
        // For example, you may want to transform it or perform additional calculations
        return $this->data->map(function ($item) {
            return [
                'NIP' => $item->NIP,
                'nama' => $item->nama,
                'sk' => $item->sk,
                'sks' => $item->sks,
                // Add more fields as needed
            ];
        });
    }

    public function headings(): array
    {
        // Define the column headings
        return [
            'NIP',
            'nama',
            'sk',
            'sks',
            // Add more headings as needed
        ];
    }
}
