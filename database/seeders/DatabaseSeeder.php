<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            ProductAttributeSeeder::class,
            StockTransactionSeeder::class
            // Tambahkan semua seeder lain di sini
        ]);
    }
}
