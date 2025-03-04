<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockOpnameServiceInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Response;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;

    public function __construct(StockOpnameServiceInterface $stockOpnameService)
    {
        $this->stockOpnameService = $stockOpnameService;
    }

    public function index()
    {
        $stockData = $this->stockOpnameService->getStockOpnameData();
        return view('manager.stock_opname.index', compact('stockData'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'manual_count' => 'required|integer|min:0',
        ]);

        $difference = $this->stockOpnameService->updateStockOpname($request->product_id, $request->manual_count);

        return redirect()->back()->with('status', "Stock updated. Difference: $difference");
    }

    public function exportStockOpname($format = 'xlsx')
    {
        // Ambil data dari database
        $stockData = \App\Models\Product::select('name', 'category', 'sku', 'current_stock', 'minimum_stock')->get();

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Kolom
        $headers = ["Product", "Category", "SKU", "Current Stock", "Minimum Stock"];
        $sheet->fromArray([$headers], null, 'A1');

        // Tambahkan Data ke Spreadsheet
        $rowIndex = 2;
        foreach ($stockData as $stock) {
            $sheet->fromArray([
                $stock->name,
                $stock->category,
                $stock->sku,
                $stock->current_stock,
                $stock->minimum_stock,
            ], null, "A$rowIndex");
            $rowIndex++;
        }

        // Atur Nama File
        $fileName = 'stock_opname.' . $format;

        // Buat Writer Sesuai Format
        if ($format === 'csv') {
            $writer = new Csv($spreadsheet);
            $contentType = 'text/csv';
        } else {
            $writer = new Xlsx($spreadsheet);
            $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        }

        // Simpan Output ke StreamedResponse
        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}
