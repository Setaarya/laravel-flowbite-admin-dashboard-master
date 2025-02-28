<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua produk yang tersedia
        $products = Product::all();

        if ($products->isEmpty()) {
            echo "Seeder gagal: Tidak ada produk dalam database. Jalankan ProductSeeder terlebih dahulu.\n";
            return;
        }

        // Loop untuk membuat 50 data dummy
        foreach (range(1, 50) as $index) {
            ProductAttribute::create([
                'product_id' => $products->random()->id, // Ambil produk secara acak
                'name' => $faker->randomElement(['Warna', 'Ukuran', 'Berat', 'Material', 'Model']),
                'value' => $faker->word(), // Nilai random
            ]);
        }
    }
}
