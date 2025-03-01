<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Models\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.reports.index');
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
}
