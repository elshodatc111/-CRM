<?php

namespace App\Exports;

use App\Models\SettingSalary;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class SalaryOshpazReportExport implements WithEvents{
    
    protected $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                // 1-qator
                $sheet->mergeCells('A1:C1');
                $sheet->setCellValue('A1', $this->data['name']);
                $sheet->setCellValue('E1', $this->data['monch']);
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('E1')->getAlignment()->setHorizontal('right');
                // 1-jadval
                $sheet->setCellValue('A3', 'Jami davomad:');
                $sheet->setCellValue('B3', $this->data['jami_bolalar']);
                $sheet->getStyle('B3')->getAlignment()->setHorizontal('right');
                $sheet->setCellValue('A4', 'Ish kunlar soni:');
                $sheet->setCellValue('B4', $this->data['countData']);
                $sheet->getStyle('B4')->getAlignment()->setHorizontal('right');
                $sheet->setCellValue('A5', "O'rtacha davomad:");
                $sheet->setCellValue('B5', $this->data['kunlik_ortacha_bolalar']);
                $sheet->getStyle('B5')->getAlignment()->setHorizontal('right');
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('A3:B5')->applyFromArray($styleArray);
                // 2-jadval     
                $sheet->setCellValue('B7', "Davomad soni");
                $sheet->setCellValue('C7', "Tarif narxi");
                $sheet->setCellValue('D7', "Ish kunlar soni");
                $sheet->setCellValue('E7', "Hisoblandi");
                $sheet->setCellValue('A8', "Tarif bo'yicha davomad");
                $sheet->setCellValue('B8', $this->data['child_pay_count']);
                $sheet->setCellValue('C8', number_format($this->data['child_pay'], 2, ',', ' '));
                $sheet->getStyle('C8')->getAlignment()->setHorizontal('right');   
                $sheet->getStyle('C9')->getAlignment()->setHorizontal('right');   
                $sheet->setCellValue('D8', $this->data['countData']);
                $hisob1 = $this->data['child_pay_count'] * $this->data['child_pay'] * $this->data['countData'];
                $sheet->setCellValue('E8', number_format($hisob1, 2, ',', ' '));   
                $sheet->getStyle('E8')->getAlignment()->setHorizontal('right');                
                $sheet->setCellValue('A9', "Bonusli davomad");
                $sheet->setCellValue('B9', $this->data['child_pay_bonus_count']);
                $sheet->setCellValue('C9', number_format($this->data['child_pay_bonus'], 2, ',', ' '));
                $sheet->getStyle('C9')->getAlignment()->setHorizontal('right');   
                $hisob2 = $this->data['child_pay_bonus'] * $this->data['child_pay_bonus_count'];
                $sheet->setCellValue('E9', number_format($hisob2, 2, ',', ' '));  
                $sheet->getStyle('E9')->getAlignment()->setHorizontal('right');              
                $sheet->setCellValue('A10', "Ish haqi"); 
                $hisob = $hisob1 + $hisob2;
                $sheet->setCellValue('E10', number_format($hisob, 2, ',', ' '));
                $sheet->getStyle('E10')->getAlignment()->setHorizontal('right');    
                $sheet->getStyle('A7:E10')->applyFromArray($styleArray);
                // Yuklangan vaqt
                $sheet->mergeCells('C12:E12');
                $sheet->setCellValue('C12', 'Yuklandi: ' . now()->format('d-m-Y H:i'));
                $sheet->getStyle('C12')->getAlignment()->setHorizontal('right');
                // Ustunlar hengligi
                $sheet->getColumnDimension('A')->setWidth(25);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(20);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(25);
            },
        ];
    }
}
