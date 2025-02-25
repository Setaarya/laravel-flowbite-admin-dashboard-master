<?php

namespace App\Http\Controllers;

use App\Services\StockService;

class ManajerController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        $data = $this->stockService->getDashboardData();
        return view('manager.home', compact('data'));
    }
}
