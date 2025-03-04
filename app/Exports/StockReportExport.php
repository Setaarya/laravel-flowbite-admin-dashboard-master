<?php
namespace App\Exports;

use App\Models\Product;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StockReportExport
{
    public function export()
    {
        $products = Product::with('category')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Header
        $headers = ['Nama Produk', 'Kategori', 'Stok'];
        $sheet->fromArray([$headers], null, 'A1');

        // Isi Data
        $data = $products->map(function ($product) {
            return [
                $product->name,
                $product->category->name ?? 'Tidak Ada Kategori',
                $product->stock,
            ];
        })->toArray();
        $sheet->fromArray($data, null, 'A2');

        // Simpan & Kirim sebagai Response
        return $this->downloadExcel($spreadsheet, 'stock_report.xlsx');
    }

    private function downloadExcel($spreadsheet, $filename)
    {
        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
?>