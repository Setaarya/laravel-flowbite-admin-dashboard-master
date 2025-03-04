<?php
namespace App\Exports;

use App\Models\StockTransaction;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TransactionReportExport
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function export()
    {
        $transactions = StockTransaction::whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->with('product')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Header
        $headers = ['Produk', 'Jumlah', 'Tipe', 'Tanggal'];
        $sheet->fromArray([$headers], null, 'A1');

        // Isi Data
        $data = $transactions->map(function ($transaction) {
            return [
                $transaction->product->name ?? 'Tidak Ada Produk',
                $transaction->quantity,
                $transaction->type,
                $transaction->transaction_date,
            ];
        })->toArray();
        $sheet->fromArray($data, null, 'A2');

        // Simpan & Kirim sebagai Response
        return $this->downloadExcel($spreadsheet, 'transaction_report.xlsx');
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