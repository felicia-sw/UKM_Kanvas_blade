<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\EventBudgetItem;
use App\Models\Event;

class ExportController extends Controller
{
    public function export($eventId)
    {
        // Ambil data event beserta budget items
        $event = Event::with(['budgetItems'])->findOrFail($eventId);

        // Pisahkan pemasukan dan pengeluaran
        $pemasukan = $event->budgetItems()->where('type', 'income')->get();
        $pengeluaran = $event->budgetItems()->where('type', 'expense')->get();

        // Path ke template Excel
        $templatePath = storage_path('app/templates/UKMKanvas_ProposalTemplate.xlsx');

        // Load template yang sudah ada
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Template file not found. Please place UKMKanvas_ProposalTemplate.xlsx in storage/app/templates/'], 404);
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // ============ SECTION PEMASUKAN ============
        // Data pemasukan dimulai dari row 46 (setelah header di row 45)
        $row = 46;
        $no = 1;
        $totalPemasukan = 0;

        foreach ($pemasukan as $item) {
            $itemTotal = $item->price * $item->quantity;
            $totalPemasukan += $itemTotal;

            $sheet->setCellValue('C' . $row, $no);
            $sheet->setCellValue('D' . $row, $item->item_name);
            $sheet->setCellValue('E' . $row, 'Rp' . number_format($item->price, 0, ',', '.'));
            $sheet->setCellValue('F' . $row, $item->quantity);
            $sheet->setCellValue('H' . $row, 'Rp' . number_format($itemTotal, 0, ',', '.'));

            $row++;
            $no++;
        }

        // Total pemasukan di row 48 (sesuai template)
        $sheet->setCellValue('H48', 'Rp' . number_format($totalPemasukan, 0, ',', '.'));

        // ============ SECTION PENGELUARAN ============
        // Data pengeluaran dimulai dari row 52 (setelah header di row 51)
        $row = 52;
        $no = 1;
        $totalPengeluaran = 0;

        foreach ($pengeluaran as $item) {
            $itemTotal = $item->price * $item->quantity;
            $totalPengeluaran += $itemTotal;

            $sheet->setCellValue('C' . $row, $no);
            $sheet->setCellValue('D' . $row, $item->item_name);
            $sheet->setCellValue('E' . $row, 'Rp' . number_format($item->price, 0, ',', '.'));
            $sheet->setCellValue('F' . $row, $item->quantity);
            $sheet->setCellValue('H' . $row, 'Rp' . number_format($itemTotal, 0, ',', '.'));

            $row++;
            $no++;
        }

        // Total pengeluaran di row 54 (sesuai template)
        $sheet->setCellValue('H54', 'Rp' . number_format($totalPengeluaran, 0, ',', '.'));

        // ============ GRAND TOTALS ============
        // TOTAL PEMASUKAN di row 56
        $sheet->setCellValue('H56', 'Rp' . number_format($totalPemasukan, 0, ',', '.'));

        // TOTAL PENGELUARAN di row 57
        $sheet->setCellValue('H57', 'Rp' . number_format($totalPengeluaran, 0, ',', '.'));

        // GRAND TOTAL di row 58
        $grandTotal = $totalPemasukan - $totalPengeluaran;
        $sheet->setCellValue('H58', 'Rp' . number_format($grandTotal, 0, ',', '.'));


        // Buat writer untuk menulis file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Event_Budget_' . $event->title . '_' . date('Y-m-d') . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Tulis file ke lokasi sementara
        $writer->save($temp_file);

        // Berikan respon file kepada pengguna
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
