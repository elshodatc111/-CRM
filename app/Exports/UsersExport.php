<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    
    public function collection(){
        return User::all();
    }
    
    public function map($row): array{
        return [
            $row->id,
            $row->role,
            $row->name,
            " ".$row->phone,
            " ".$row->phone_two,
            $row->addres,
            $row->salary,
            $row->tkun->format("Y-m-d"),
            $row->pasport,
            $row->about,
            $row->created_at->format('d.m.Y H:i'),
            $row->updated_at->format('d.m.Y H:i'),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Lavozim',
            'Hodim',
            'Telefon raqam',
            'Telefon raqam',
            'Manzil',
            'Ish haqi',
            'Tug\'ilgan kuni',
            'Pasport',
            'Hodim haqida',
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
            'A1:L' . ($this->collection()->count() + 1) => [
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
