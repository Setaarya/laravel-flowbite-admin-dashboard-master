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
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            ProductAttributeSeeder::class,
            StockTransactionSeeder::class,
            SettingsTableSeeder::class,
            UsersTableSeeder::class
            // Tambahkan semua seeder lain di sini
        ]);
    }
}
