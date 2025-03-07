<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser(User $user, array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user)
    {
        return $this->userRepository->delete($user);
    }

    public function validateUserData(Request $request, $id = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => $id ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Staff Gudang,Manager Gudang',
        ]);
    }

    public function updateSetting($id, $data)
    {
        $validatedData = validator($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
        ])->validate();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        return $this->userRepository->update($id, $validatedData);
    }
}
