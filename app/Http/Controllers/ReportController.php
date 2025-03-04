<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\ExportService;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $exportService;
    protected $service;

    public function __construct(ExportService $exportService, ReportService $service)
    {
        $this->exportService = $exportService;
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.reports.index');
    }
    
    public function managerindex()
    {
        return view('manager.reports.index');
    }

    public function stockindex(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->input('category_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->service->generateReport($categoryId, $startDate, $endDate);

        return view('admin.reports.stock_report', compact('data', 'categories', 'categoryId', 'startDate', 'endDate'));
    }

    public function transactionindex(Request $request)
    {
        $filters = [
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            'stock_order' => $request->input('stock_order'),
            'price_order' => $request->input('price_order'),
            'transaction_order' => $request->input('transaction_order'),
        ];

        $products = $this->service->getReportData($filters);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.reports.transaction_report', compact('products', 'categories', 'suppliers', 'filters'));
    }

    // Endpoint untuk mengekspor laporan transaksi
    public function exportTransactionReport(Request $request)
    {
        return $this->exportService->transactionexport($request->all());
    }

    // Endpoint untuk mengekspor laporan stok
    public function exportStockReport(Request $request)
    {
        return $this->exportService->stockexport($request->all());
    }

    
    public function managerstockindex(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->input('category_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->service->generateReport($categoryId, $startDate, $endDate);

        return view('manager.reports.stock_report', compact('data', 'categories', 'categoryId', 'startDate', 'endDate'));
    }

    public function managertransactionindex(Request $request)
    {
        $filters = [
            'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            'stock_order' => $request->input('stock_order'),
            'price_order' => $request->input('price_order'),
            'transaction_order' => $request->input('transaction_order'),
        ];

        $products = $this->service->getReportData($filters);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('manager.reports.transaction_report', compact('products', 'categories', 'suppliers', 'filters'));
    }

}
