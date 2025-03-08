<?php

namespace App\Services;

use App\Repositories\StockOpnameRepositoryInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StockOpnameService implements StockOpnameServiceInterface
{
    protected $stockOpnameRepository;

    public function __construct(StockOpnameRepositoryInterface $stockOpnameRepository)
    {
        $this->stockOpnameRepository = $stockOpnameRepository;
    }

    public function getStockOpnameData()
    {
        return $this->stockOpnameRepository->getAllStockOpname();
    }

    public function updateManualCount($id, $manualCount)
    {
        $stockOpname = $this->stockOpnameRepository->findById($id);

        if (!$stockOpname) {
            return null;
        }

        // Hitung perbedaan stok
        $difference = $manualCount - $stockOpname->current_stock;

        // Tentukan status
        if ($difference > 0) {
            $status = "Surplus (+$difference)";
        } elseif ($difference < 0) {
            $status = "Minus ($difference)";
        } else {
            $status = "Balanced (0)";
        }

        // Update ke database
        $stockOpname->manual_count = $manualCount;
        $stockOpname->status = $status;
        $stockOpname->save();

        return $stockOpname;
    }

    public function findById($id)
    {
        return $this->stockOpnameRepository->findById($id);
    }

    public function saveStockOpname($stockData)
    {
        return $this->stockOpnameRepository->saveStockOpname($stockData);
    }

    public function getLatestStockOpname()
    {
        return $this->stockOpnameRepository->getLatestStockOpname();
    }

    public function adjustStock($id, $adjustmentValue)
    {
        return $this->stockOpnameRepository->adjustStock($id, $adjustmentValue);
    }

    public function adminexportToExcel(): BinaryFileResponse
    {
        $stockOpnames = $this->stockOpnameRepository->getLatestStockOpnameAdmin();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['Product', 'Category', 'SKU', 'Stock Sebelum Adjustment', 'Stock Setelah Adjustment', 'Manual Count', 'Status'];
        $sheet->fromArray($headers, null, 'A1');

        // Data
        $row = 2;
        foreach ($stockOpnames as $stock) {
            $sheet->fromArray([
                $stock->product->name,
                $stock->category->name,
                $stock->product->sku,
                $stock->before_adjustment,  // Stock sebelum adjustment
                $stock->product->current_stock, // Stock setelah adjustment
                $stock->manual_count,
                $stock->status
            ], null, "A$row");
            $row++;
        }

        // Styling Header
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFDDDDDD']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Auto-size columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'laporan_stok.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), 'temp_') . '.xlsx'; // Pastikan ekstensi .xlsx

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
