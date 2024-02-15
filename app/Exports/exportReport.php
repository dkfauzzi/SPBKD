<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Exports\exportReport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class exportReport implements FromCollection, WithHeadings, WithMultipleSheets, WithStyles
{
    protected $data;
    protected $skData;
    protected $dosenData;
    protected $kkData;
    protected $prodiData;

    public function __construct(Collection $data, Collection $skData, Collection $dosenData, Collection $kkData, Collection $prodiData)
    {
        $this->data = $data;
        $this->skData = $skData;
        $this->dosenData = $dosenData;
        $this->kkData = $kkData;
        $this->prodiData = $prodiData;

    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Jumlah Semester 1 SKS',
            'Jumlah Semester 2 SKS',
            'Total SKS',
            'Jumlah Semester 1 SK',
            'Jumlah Semester 2 SK',
            'Total SK',
        ];
    }

    public function collection()
    {
        return $this->data;
    }

    public function sheets(): array
    {
        $sheets = [
            new SheetKegiatanSK($this->skData, 'Kegiatan SK'),
            new SheetProdi($this->prodiData, 'Program Studi'),
            new SheetKK($this->kkData, 'Kelompok Keahlian'),
            new SheetDosen($this->dosenData, 'Dosen'),

        ];

        // // Add the main data sheet
        // $sheets[] = new SheetKegiatanSK($this->skData);
        // $sheets[] = new SheetDosen($this->dosenData);
        // $sheets[] = new SheetKK($this->kkData);
        // $sheets[] = new SheetProdi($this->prodiData);

        return $sheets;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '336699'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A2:H' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('E2:E' . $sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'], 
            ],
        ]);

        $sheet->getStyle('H2:H' . $sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'], 
            ],
        ]);
    }
}


