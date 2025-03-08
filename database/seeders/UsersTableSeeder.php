<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Gantilah dengan password yang aman
            'role' => 'Admin',
        ]);

        // Manajer Gudang
        User::create([
            'name' => 'Manager Gudang',
            'email' => 'manager@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Manajer Gudang',
        ]);

        // Staff Gudang
        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Staff Gudang',
        ]);
    }
}
