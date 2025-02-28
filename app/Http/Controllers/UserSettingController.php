<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('settings.index', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $this->userService->updateUser(Auth::user()->id, $request->all());
        return redirect()->route('settings.index')->with('success', 'Data berhasil diperbarui.');
    }
}
