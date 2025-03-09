<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\ExportService;
use App\Services\CategoryService;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    protected $exportService;
    protected $service;
    protected $categoryService;
    protected $supplierService;

    public function __construct(
        ExportService $exportService,
        ReportService $service,
        CategoryService $categoryService,
        SupplierService $supplierService
    ) {
        $this->exportService = $exportService;
        $this->service = $service;
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
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
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|exists:categories,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categories = $this->categoryService->getAllCategories();
        $categoryId = $request->input('category_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->service->generateReport($categoryId, $startDate, $endDate);

        return view('admin.reports.stock_report', compact('data', 'categories', 'categoryId', 'startDate', 'endDate'));
    }

    public function transactionindex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'stock_order' => 'nullable|in:asc,desc',
            'price_order' => 'nullable|in:asc,desc',
            'transaction_order' => 'nullable|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $filters = $request->only(['category_id', 'supplier_id', 'stock_order', 'price_order', 'transaction_order']);
        $products = $this->service->getReportData($filters);
        $categories = $this->categoryService->getAllCategories();
        $suppliers = $this->supplierService->getAllSuppliers();

        return view('admin.reports.transaction_report', compact('products', 'categories', 'suppliers', 'filters'));
    }

    public function exportTransactionReport(Request $request)
    {
        return $this->exportService->transactionexport($request->all());
    }

    public function exportStockReport(Request $request)
    {
        return $this->exportService->stockexport($request->all());
    }

    public function managerstockindex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|exists:categories,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categories = $this->categoryService->getAllCategories();
        $categoryId = $request->input('category_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->service->generateReport($categoryId, $startDate, $endDate);

        return view('manager.reports.stock_report', compact('data', 'categories', 'categoryId', 'startDate', 'endDate'));
    }

    public function managertransactionindex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'stock_order' => 'nullable|in:asc,desc',
            'price_order' => 'nullable|in:asc,desc',
            'transaction_order' => 'nullable|in:asc,desc',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $filters = $request->only(['category_id', 'supplier_id', 'stock_order', 'price_order', 'transaction_order']);
        $products = $this->service->getReportData($filters);
        $categories = $this->categoryService->getAllCategories();
        $suppliers = $this->supplierService->getAllSuppliers();

        return view('manager.reports.transaction_report', compact('products', 'categories', 'suppliers', 'filters'));
    }
}
