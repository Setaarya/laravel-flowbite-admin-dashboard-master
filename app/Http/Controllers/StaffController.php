<?php

namespace App\Http\Controllers;

use App\Services\StaffDashboardServiceInterface;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $dashboardService;

    public function __construct(StaffDashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $tasks = $this->dashboardService->getTasks();
        return view('staff.home', compact('tasks'));
    }
}
