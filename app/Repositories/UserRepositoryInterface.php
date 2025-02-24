<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(User $user, array $data);
    public function delete(User $user);
    public function findByEmail(string $email);
}
