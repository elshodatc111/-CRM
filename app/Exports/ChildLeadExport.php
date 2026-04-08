<?php

namespace App\Exports;

use App\Models\ChildLead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ChildLeadExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    
    public function collection(){
        return ChildLead::all();
    }
    
    public function map($row): array{
        return [
            $row->id,
            $row->name,
            " ".$row->phone,
            " ".$row->phone_two,
            $row->ota_ona,
            $row->tkun->format('Y-m-d'),
            $row->address,
            $row->jinsi,
            $row->description,
            $row->creator->name,
            $row->status,
            $row->child_id,
            $row->created_at->format('d.m.Y H:i'),
            $row->updated_at->format('d.m.Y H:i'),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Bola FIO',
            'Telefon raqam',
            'Telefon raqam',
            'Ota onasi',
            'Tug\'ilgan kuni',
            'Yashash manzili',
            'Jinsi',
            'Bola haqida',
            'Ro\'yhatga oldi',
            'Lead holati',
            'Bola ID',
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
            'A1:N' . ($this->collection()->count() + 1) => [
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
