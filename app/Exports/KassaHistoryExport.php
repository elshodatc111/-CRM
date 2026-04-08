<?php

namespace App\Exports;

use App\Models\KassaHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KassaHistoryExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{

    public function collection(){
        return KassaHistory::all();
    }
    
    public function map($row): array{
        return [
            $row->id,
            $row->type,
            $row->amount,
            $row->amount_type,
            $row->status,
            $row->start_data->format('Y-m-d'),
            $row->startAdmin->name,
            $row->start_comment,
            $row->end_data,
            $row->end_data!=null?$row->endAdmin->name:null,
            $row->child_payment_id,
            $row->created_at->format('d.m.Y H:i'),
            $row->updated_at->format('d.m.Y H:i'),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Operatsiya turi',
            'To\'lov summasi',
            'To\'lov turi',
            'To\'lov holati',
            'To\'lov vaqt',
            'Qabul qildi',
            'Izoh / Kommentariya',
            'Tasdiqlandi',
            'Tasdiqladi',
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
            'A1:M' . ($this->collection()->count() + 1) => [
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
