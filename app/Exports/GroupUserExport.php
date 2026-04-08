<?php

namespace App\Exports;

use App\Models\GroupUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GroupUserExport implements FromCollection , WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    public function collection(){
        return GroupUser::all();
    }
    public function map($row): array{
        return [
            $row->id,
            $row->user->name,
            $row->group->group_name,
            $row->assignedBy->name,
            $row->start_data->format('Y-m-d'),
            $row->end_id?$row->removedBy->name:"",
            $row->end_data,
            $row->is_active?"Aktiv":"O'chirilgan",
            $row->created_at->format('d.m.Y H:i'),
            $row->updated_at->format('d.m.Y H:i'),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            "Tarbiyachi",
            "Guruh",
            "Guruhga qo'shdi",
            "Guruhga qo'shildi",
            "Guruhdan o'chirdi",
            "Guruhdan o'chirildi",
            "Guruhdagi holati",
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
            'A1:J' . ($this->collection()->count() + 1) => [
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
