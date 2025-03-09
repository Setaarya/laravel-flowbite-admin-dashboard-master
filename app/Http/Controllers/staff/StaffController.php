<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Services\StaffDashboardService;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $dashboardService;

    public function __construct(StaffDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $tasks = $this->dashboardService->getTasks();
        return view('staff.home', compact('tasks'));
    }
}
