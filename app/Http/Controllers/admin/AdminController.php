<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $dashboardService;

    public function __construct(AdminDashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        // Example period: the last month
        $startDate = now()->subMonth()->toDateString();
        $endDate = now()->toDateString();

        $data = $this->dashboardService->getDashboardData($startDate, $endDate);
        return view('admin.home', compact('data'));
    }
}