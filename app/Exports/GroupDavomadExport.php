<?php

namespace App\Exports;

use App\Models\GroupDavomad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class GroupDavomadExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{

    public function collection(){
        return GroupDavomad::all();
    }

    public function map($row): array{
        return [
            $row->id,
            $row->group->group_name,
            $row->child->name,
            $row->status,
            $row->date->format("Y-m-d"),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Guruh',
            'Bola',
            'Davomad Holati',
            'Davomad Kuni',
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
            'A1:E' . ($this->collection()->count() + 1) => [
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
