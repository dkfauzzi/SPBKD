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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;



class SheetKK implements  FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $data;
    protected $title;


    public function __construct(Collection $data, string $title)
    {
        $this->data = $data;
        $this->title = $title;

        
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return [
            'Kelompok Keahlian',
            'Jumlah SKS Semester 1',
            'Jumlah SKS Semester 2',
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

    public function styles(Worksheet $sheet)
    {
        // Apply styles to the heading row
        $sheet->getStyle('A1:G1')->applyFromArray([
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

        // Apply styles to the data cells
        $sheet->getStyle('A2:G' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Apply color to cells under 'Total SKS' and 'Total SK'
        $sheet->getStyle('D2:D' . $sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'], // Yellow color
            ],
        ]);

        $sheet->getStyle('G2:G' . $sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'], // Yellow color
            ],
        ]);
    }
    
}
