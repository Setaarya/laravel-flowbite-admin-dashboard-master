<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->userService->validateUserData($request);
        $this->userService->createUser($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show($userId)
    {
        $user = $this->userService->getUserById($userId);
        return view('admin.users.show', compact('user'));
    }

    public function edit($userId)
    {
        $user = $this->userService->getUserById($userId);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $userId)
    {
        $validatedData = $this->userService->validateUserData($request, $userId);
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }
        $this->userService->updateUser($userId, $validatedData);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($userId)
    {
        $this->userService->deleteUser($userId);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function adminindex()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }
}
