<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Services\ManagerDashboardService;
class ManajerController extends Controller
{
    protected $stockService;

    public function __construct(ManagerDashboardService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        $data = $this->stockService->getDashboardData();
        return view('manager.home', compact('data'));
    }
}
