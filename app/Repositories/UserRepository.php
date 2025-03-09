<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        return User::where('id', $id)->update($data);
    }

    public function updateSetting($id, array $data)
    {
        return User::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
