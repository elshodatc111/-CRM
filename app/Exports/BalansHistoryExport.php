<?php
namespace App\Exports;

use App\Models\BalansHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BalansHistoryExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{
    
    public function collection(){
        return BalansHistory::all();
    }
    
    public function map($row): array{
        return [
            $row->id,
            $row->type,
            $row->amount,
            $row->amount_type,
            $row->description,
            $row->admin->name,
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
            'Izoh / Kommentariya',
            'Hodim',
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