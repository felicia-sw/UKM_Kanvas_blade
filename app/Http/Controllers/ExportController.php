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

        // Make sure column G is visible and unmerged
        $sheet->getColumnDimension('G')->setVisible(true);
        $sheet->getColumnDimension('G')->setCollapsed(false);

        // ============ SECTION PEMASUKAN ============
        // Data pemasukan dimulai dari row 46 (setelah header di row 45)
        $row = 46;
        $no = 1;
        $totalPemasukan = 0;

        foreach ($pemasukan as $item) {
            // Insert new row if we have more than 2 items (template has 2 rows: 46-47)
            if ($no > 2) {
                $sheet->insertNewRowBefore($row, 1);
            }

            $itemTotal = $item->price * $item->quantity;
            $totalPemasukan += $itemTotal;

            $sheet->setCellValue('C' . $row, $no);
            $sheet->setCellValue('D' . $row, $item->item_name);
            $sheet->setCellValue('E' . $row, 'Rp' . number_format($item->price, 0, ',', '.'));
            $sheet->mergeCells('E' . $row . ':F' . $row);
            $sheet->setCellValueExplicit('G' . $row, $item->quantity, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
            $sheet->setCellValue('H' . $row, 'Rp' . number_format($itemTotal, 0, ',', '.'));

            $row++;
            $no++;
        }

        // Calculate dynamic row for total pemasukan (row after last data)
        $totalPemasukanRow = $row;
        $sheet->setCellValue('H' . $totalPemasukanRow, 'Rp' . number_format($totalPemasukan, 0, ',', '.'));

        // ============ SECTION PENGELUARAN ============
        // Pengeluaran starts 4 rows after total pemasukan (accounting for spacing and headers)
        $pengeluaranStartRow = $totalPemasukanRow + 4;
        $row = $pengeluaranStartRow;
        $no = 1;
        $totalPengeluaran = 0;

        foreach ($pengeluaran as $item) {
            // Insert new row if we have more than 2 items (template has 2 rows: 52-53)
            if ($no > 2) {
                $sheet->insertNewRowBefore($row, 1);
            }

            $itemTotal = $item->price * $item->quantity;
            $totalPengeluaran += $itemTotal;

            $sheet->setCellValue('C' . $row, $no);
            $sheet->setCellValue('D' . $row, $item->item_name);
            $sheet->setCellValue('E' . $row, 'Rp' . number_format($item->price, 0, ',', '.'));
            $sheet->mergeCells('E' . $row . ':F' . $row);
            $sheet->setCellValueExplicit('G' . $row, $item->quantity, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
            $sheet->setCellValue('H' . $row, 'Rp' . number_format($itemTotal, 0, ',', '.'));

            $row++;
            $no++;
        }

        // Calculate dynamic row for total pengeluaran
        $totalPengeluaranRow = $row;
        $sheet->setCellValue('H' . $totalPengeluaranRow, 'Rp' . number_format($totalPengeluaran, 0, ',', '.'));

        // ============ GRAND TOTALS ============
        // Grand totals start 2 rows after total pengeluaran
        $grandTotalStartRow = $totalPengeluaranRow + 2;

        // TOTAL PEMASUKAN
        $sheet->setCellValue('H' . $grandTotalStartRow, 'Rp' . number_format($totalPemasukan, 0, ',', '.'));

        // TOTAL PENGELUARAN
        $sheet->setCellValue('H' . ($grandTotalStartRow + 1), 'Rp' . number_format($totalPengeluaran, 0, ',', '.'));

        // GRAND TOTAL
        $grandTotal = $totalPemasukan - $totalPengeluaran;
        $sheet->setCellValue('H' . ($grandTotalStartRow + 2), 'Rp' . number_format($grandTotal, 0, ',', '.'));


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
