<?php

namespace App\Exports;

use App\Models\UserLead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserLeadExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithMapping{

    public function collection(){
        return UserLead::all();
    }

    public function map($row): array{
        return [
            $row->id,
            $row->name,
            " ".$row->phone,
            " ".$row->phone_two,
            $row->address,
            $row->expected_salary,
            $row->birth_date->format("Y-m-d"),
            $row->role,
            $row->education,
            $row->institution_name,
            $row->last_workplace,
            $row->manba,
            $row->maqsadi,
            $row->about,
            $row->status,
            $row->user_id,
            $row->admin->name,
            $row->created_at->format('d.m.Y H:i'),
            $row->updated_at->format('d.m.Y H:i'),
        ];
    }
    
    public function headings(): array{
        return [
            'ID',
            'Hodim',
            'Telefon raqam',
            'Telefon raqam',
            'Manzil',
            'Kutayotgan ish haqi',
            'Tug\'ilgan kuni',
            'Lavozim',
            'Talim',
            'Talim muassasi',
            'Oldingi ish joyi',
            'Manba',
            'Maqsadi',
            'Lead haqida',
            'Lead status',
            'UserID',
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
            'A1:S' . ($this->collection()->count() + 1) => [
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
