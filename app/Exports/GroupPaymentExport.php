<?php

namespace App\Exports;

use App\Models\GroupPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GroupPaymentExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    
    public function collection(){
        return GroupPayment::all();
    }

    public function map($row): array{
        return [
            $row->id,
            $row->child->name,
            $row->group->group_name,
            $row->month_pay,
            $row->desctiption,
            $row->balans_start,
            $row->payment,
            $row->balans_end,
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            "Bola",
            "Guruh",
            "To'langan oy",
            "To'lov haqida",
            "Balns",
            "To'lov",
            "Qoldiq",
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4CAF50'] // Yashil rang (Success)
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'A1:H' . ($this->collection()->count() + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}
