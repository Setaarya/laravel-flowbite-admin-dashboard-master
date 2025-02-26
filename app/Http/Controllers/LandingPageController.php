<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard');
    }

}
