<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Pastikan kategori dan supplier tersedia
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $supplierIds = DB::table('suppliers')->pluck('id')->toArray();

        if (empty($categoryIds) || empty($supplierIds)) {
            $this->command->warn('Kategori atau Supplier belum ada. Silakan jalankan seeder untuk kategori dan supplier terlebih dahulu.');
            return;
        }

        foreach (range(1, 20) as $index) {
            DB::table('products')->insert([
                'category_id'    => $faker->randomElement($categoryIds),
                'supplier_id'    => $faker->randomElement($supplierIds),
                'name'           => $faker->word . ' ' . $faker->randomElement(['A', 'B', 'C']),
                'sku'            => strtoupper($faker->bothify('SKU-#######')),
                'description'    => $faker->sentence,
                'purchase_price' => $faker->randomFloat(2, 1000, 10000),
                'selling_price'  => $faker->randomFloat(2, 1500, 12000),
                'image'          => $faker->imageUrl(200, 200, 'products', true, 'Faker'),
                'current_stock'  => $faker->numberBetween(100, 1000), // Memperbaiki kesalahan sebelumnya
                'minimum_stock'  => $faker->numberBetween(5, 50),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
