<?php

namespace App\Exports;

use App\Models\UserShikoyat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserShikoyatHodimExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    
    public function collection(){
        return UserShikoyat::all();
    }
    public function map($row): array{
        return [
            $row->id,
            $row->user->name,
            $row->desctiption,
            $row->admin->name,
            $row->created_at->format('d.m.Y H:i'),
            $row->updated_at->format('d.m.Y H:i'),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Hodim',
            'Shikoyat haqida',
            'Administrator',
            'Yaratilgan vaqt',
            'Yangilangan vaqt',
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
