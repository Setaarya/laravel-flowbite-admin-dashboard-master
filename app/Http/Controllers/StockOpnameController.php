<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockOpnameServiceInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

    public function adminindex()
    {
        $stockData = $this->stockOpnameService->getStockOpnameData();
        return view('admin.stock_opname.index', compact('stockData'));
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

    public function exportToExcel()
    {
        // Ambil semua data dari tabel Stock Opname
        $stockData = $this->stockOpnameService->getStockOpnameData();

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $headers = ['Product', 'Category', 'SKU', 'Current Stock', 'Minimum Stock', 'Manual Count', 'Status'];
        $sheet->fromArray($headers, null, 'A1');

        // Isi data dari database ke dalam sheet
        $row = 2;
        foreach ($stockData as $stock) {
            $sheet->fromArray([
                $stock->name,
                $stock->category_id,
                $stock->sku,
                $stock->current_stock,
                $stock->minimum_stock,
                '', // Manual count (kosong karena input di UI)
                'Balanced (0)' // Status default
            ], null, "A{$row}");
            $row++;
        }

        // Set header response
        $fileName = 'Stock_Opname_' . date('Y-m-d') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
