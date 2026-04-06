<?php

namespace App\Exports;

use App\Models\SettingSalary;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class SalaryAdminReportExport implements WithEvents{
    
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $userName = User::find($this->data['user_id'])->name;
                $month = $this->data['monch'];
                $baseSalary = (float)User::find($this->data['user_id'])->salary;
                $newChildCount = (int)$this->data['new_child_count'];
                $newLeadCount = (int)$this->data['new_lead_count'];
                $childPrice = SettingSalary::find(6)->new_child; 
                $leadPrice = SettingSalary::find(6)->new_lead;                
                $totalChild = $newChildCount * $childPrice;
                $totalLead = $newLeadCount * $leadPrice;
                $grandTotal = $baseSalary + $totalChild + $totalLead;

                $sheet->mergeCells('A1:C1');
                $sheet->setCellValue('A1', $userName);
                $sheet->setCellValue('D1', $month);
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('D1')->getAlignment()->setHorizontal('right');
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                // 3-qator: Maosh miqdori
                $sheet->setCellValue('A3', 'Maosh miqdori');
                $sheet->setCellValue('B3', number_format($baseSalary, 2, ',', ' '));
                $sheet->getStyle('B3')->getAlignment()->setHorizontal('right');
                $sheet->setCellValue('C3', 1);
                $sheet->setCellValue('D3', number_format($baseSalary, 2, ',', ' '));
                $sheet->getStyle('D3')->getAlignment()->setHorizontal('right');

                // 4-qator: Yangi bolalar
                $sheet->setCellValue('A4', 'Yangi bolalar');
                $sheet->setCellValue('B4', number_format($childPrice, 2, ',', ' '));
                $sheet->getStyle('B4')->getAlignment()->setHorizontal('right');
                $sheet->setCellValue('C4', $newChildCount);
                $sheet->setCellValue('D4', number_format($totalChild, 2, ',', ' '));
                $sheet->getStyle('D4')->getAlignment()->setHorizontal('right');

                // 5-qator: Yangi lead
                $sheet->setCellValue('A5', 'Yangi leat');
                $sheet->setCellValue('B5', number_format($leadPrice, 2, ',', ' '));
                $sheet->getStyle('B5')->getAlignment()->setHorizontal('right');
                $sheet->setCellValue('C5', $newLeadCount);
                $sheet->setCellValue('D5', number_format($totalLead, 2, ',', ' '));
                $sheet->getStyle('D5')->getAlignment()->setHorizontal('right');

                // 6-qator: Jami
                $sheet->setCellValue('D6', number_format($grandTotal, 2, ',', ' '));
                $sheet->getStyle('D6')->getAlignment()->setHorizontal('right');
                $sheet->getStyle('D6')->getFont()->setBold(true);

                // Borderlarni qo'llash (A3 dan D6 gacha)
                $sheet->getStyle('A3:D6')->applyFromArray($styleArray);

                // 8-qator: Yuklangan vaqti
                $sheet->mergeCells('C8:D8');
                $sheet->setCellValue('C8', 'Yuklandi: ' . now()->format('d-m-Y H:i'));
                $sheet->getStyle('C8')->getAlignment()->setHorizontal('right');

                // Ustun kengliklarini sozlash
                $sheet->getColumnDimension('A')->setWidth(30);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(10);
                $sheet->getColumnDimension('D')->setWidth(20);
            },
        ];
    }
}