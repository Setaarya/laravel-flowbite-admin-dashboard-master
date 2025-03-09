<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Repositories\ReportRepository;

class ExportService
{
    protected $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function transactionexport($filters)
    {
        $transactions = $this->reportRepository->getReport($filters);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['Nama Produk', 'Kategori', 'Supplier', 'SKU', 'Harga Beli', 'Harga Jual', 'Stok Saat Ini', 'Tipe Transaksi', 'Jumlah', 'Total Harga Jual', 'Total Harga Beli', 'Tanggal'];
        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        foreach ($transactions as $transaction) {
            $sheet->fromArray([
                $transaction->product_name,
                $transaction->category_name ?? 'Tidak Ada Kategori',
                $transaction->supplier_name ?? 'Tidak Ada Supplier',
                $transaction->sku,
                $transaction->purchase_price,
                $transaction->selling_price,
                $transaction->current_stock,
                ucfirst($transaction->type),
                $transaction->total_quantity,
                $transaction->total_selling_price ?? '-',
                $transaction->total_purchasing_price ?? '-',
                $transaction->date
            ], null, "A$row");

            $row++;
        }


        $fileName = 'laporan_transaksi.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName);
    }

    public function stockexport($filters)
    {
        $stocks = $this->reportRepository->getFilteredProducts($filters);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['Nama Produk', 'Kategori', 'Supplier', 'SKU', 'Harga Beli', 'Harga Jual', 'Stok Saat Ini', 'Total Masuk', 'Total Keluar', 'Atribut Produk'];
        $sheet->fromArray($headers, null, 'A1');

        $row = 2;
        foreach ($stocks as $stock) {
            $sheet->fromArray([
                $stock->product_name,
                $stock->category_name ?? 'Tidak Ada Kategori',
                $stock->supplier_name ?? 'Tidak Ada Supplier',
                $stock->sku,
                $stock->purchase_price,
                $stock->selling_price,
                $stock->current_stock,
                $stock->total_in ?? 0,
                $stock->total_out ?? 0,
                $stock->attributes ?? 'Tidak Ada Atribut'
            ], null, "A$row");

            $row++;
        }

        $fileName = 'laporan_stok.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName);
    }
}


?>
