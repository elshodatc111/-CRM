<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SalaryAdminReportExport implements WithEvents{

    protected $data;
    protected $davomad;
    protected $shikoyat;

    public function __construct($data, $davomad, $shikoyat){$this->data = $data;$this->davomad = $davomad;$this->shikoyat = $shikoyat;}

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                // --- 1. ISH HAQI JADVALI (A-D ustunlar) ---
                $sheet->mergeCells('A1:B1');
                $sheet->setCellValue('A1', 'Administrator: ' . ($this->data['admin_name'] ?? 'Noma’lum'));
                $sheet->setCellValue('D1', 'Yuklandi: ' . date('Y-m-d H:i:s'));

                $headers1 = ['#', 'Summa', 'Soni', 'Hisoblash'];
                $sheet->fromArray([$headers1], NULL, 'A2');

                $currentRow = 3;
                foreach ($this->data['items'] as $item) {
                    $sheet->setCellValue('A' . $currentRow, $item['title']);
                    $sheet->setCellValue('B' . $currentRow, $item['summa']);
                    $sheet->setCellValue('C' . $currentRow, $item['soni']);
                    $sheet->setCellValue('D' . $currentRow, $item['total']);
                    $currentRow++;
                }
                $sheet->setCellValue('D' . $currentRow, $this->data['total_all'] ?? 0);
                $sheet->getStyle("A2:D$currentRow")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // --- 2. DAVOMAD JADVALI (F-I ustunlar) ---
                $sheet->setCellValue('F1', 'Hodim Davomad');
                $sheet->setCellValue('I1', date('2026-04')); // Oyni dinamik qilish mumkin

                $headers2 = ['#', 'Davomad Kuni', 'Davomad holati', 'Davomad haqida'];
                $sheet->fromArray([$headers2], NULL, 'F2');

                $attRow = 3;
                foreach ($this->davomad as $index => $att) {
                    $sheet->setCellValue('F' . $attRow, $index + 1);
                    $sheet->setCellValue('G' . $attRow, $att['sana']);
                    $sheet->setCellValue('H' . $attRow, $att['holat']);
                    $sheet->setCellValue('I' . $attRow, $att['izoh']);

                    // Rang berish (Rasmdagidek)
                    $color = $this->getStatusColor($att['holat']);
                    if ($color) {
                        $sheet->getStyle('H' . $attRow)->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()->setARGB($color);
                    }
                    $attRow++;
                }
                $sheet->getStyle("F2:I" . ($attRow - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // --- 3. SHIKOYATLAR JADVALI (Pastki qism) ---
                $shikoyatStart = $currentRow + 2; // Ish haqi jadvalidan 2 qator pastda
                $sheet->setCellValue('A' . $shikoyatStart, 'Shikoyatlar');
                $sheet->setCellValue('D' . $shikoyatStart, date('2026-04'));

                $headers3 = ['#', 'Shikoyatlar matni', 'Administrator', 'Shikoyat vaqti'];
                $sheet->fromArray([$headers3], NULL, 'A' . ($shikoyatStart + 1));

                $compRow = $shikoyatStart + 2;
                foreach ($this->shikoyat as $index => $sh) {
                    $sheet->setCellValue('A' . $compRow, $index + 1);
                    $sheet->setCellValue('B' . $compRow, $sh['matn']);
                    $sheet->setCellValue('C' . $compRow, $sh['admin']);
                    $sheet->setCellValue('D' . $compRow, $sh['vaqt']);
                    $compRow++;
                }
                $sheet->getStyle("A" . ($shikoyatStart + 1) . ":D" . ($compRow - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Ustunlar kengligini avtomatik sozlash
                foreach (range('A', 'I') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }

    // Holatga qarab rang qaytaruvchi yordamchi funksiya
    private function getStatusColor($status)
    {
        return match ($status) {
            'keldi', 'kelmadi_sababli' => 'C6EFCE', // Yashil
            'keldi_formasiz', 'kechikdi_sababli' => 'FFEB9C', // Sariq
            'kechikdi_formasiz', 'kechikdi_sababsiz', 'kelmadi' => 'FFC7CE', // Qizil
            default => null,
        };
    }
}