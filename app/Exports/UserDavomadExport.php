<?php

namespace App\Exports;

use App\Models\UserDavomad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserDavomadExport implements FromCollection,WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    
    public function collection(){
        return UserDavomad::all();
    }
        public function map($row): array{
        return [
            $row->id,
            $row->user->name,
            $row->data->format("Y-m-d"),
            $row->status,
            $row->description,
            $row->admin->name,
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Hodim',
            'Davomad Kuni',
            'Davomad haqida',
            'Davomad Holati',
            'Administrator',
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
            'A1:F' . ($this->collection()->count() + 1) => [
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
