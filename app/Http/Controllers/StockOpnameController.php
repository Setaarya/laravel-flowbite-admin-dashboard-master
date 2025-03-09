<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockOpnameService;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;

    public function __construct(StockOpnameService $stockOpnameService)
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

    public function updateManualCount(Request $request, $id)
    {
        $manualCount = $request->input('manual_count');

        // Cari data stock opname berdasarkan ID
        $stockOpname = $this->stockOpnameService->findById($id);

        if (!$stockOpname) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hitung selisih stok
        $difference = $manualCount - $stockOpname->current_stock;
        if ($difference > 0) {
            $status = "Surplus (+{$difference})";
        } elseif ($difference < 0) {
            $status = "Minus ({$difference})";
        } else {
            $status = "Balanced (0)";
        }

        // Update di database
        $stockOpname->update([
            'manual_count' => $manualCount,
            'status' => $status
        ]);

        return response()->json([
            'status' => $status
        ]);
    }


    public function exportToExcel()
    {
        $stockData = $this->stockOpnameService->getStockOpnameData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $headers = ['Product', 'Category', 'SKU', 'Current Stock', 'Minimum Stock', 'Manual Count', 'Status'];
        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        foreach ($stockData as $stock) {
            $sheet->fromArray([
                $stock->name,
                $stock->category,
                $stock->sku,
                $stock->current_stock,
                $stock->minimum_stock,
                $stock->manual_count, // Data terbaru dari database
                $stock->status // Data terbaru dari database
            ], null, "A{$row}");
            $row++;
        }

        $fileName = 'Stock_Opname_' . date('Y-m-d') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
        ]);
    }

    public function saveStockOpname(Request $request)
    {
        $stockData = $request->input('stockData');

        $this->stockOpnameService->saveStockOpname($stockData);

        return response()->json(['message' => 'Stock Opname berhasil disimpan!']);
    }


    public function showLatestStockOpname()
    {
        $stockData = $this->stockOpnameService->getLatestStockOpname();
        return view('admin.stock_opname.index', compact('stockData'));
    }

    public function adjustStock(Request $request, $id)
    {
        $request->validate([
            'adjustment_value' => 'required|integer|min:0',
        ]);

        $updatedStock = $this->stockOpnameService->adjustStock($id, $request->adjustment_value);

        return response()->json([
            'message' => 'Stock berhasil disesuaikan!',
            'new_stock' => $updatedStock->manual_count,
            'status' => $updatedStock->status
        ]);
    }

    public function exportStockOpname()
    {
        return $this->stockOpnameService->adminexportToExcel();
    }

}
