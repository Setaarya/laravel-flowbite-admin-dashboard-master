<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Peralatan elektronik seperti laptop, handphone, dll.'],
            ['name' => 'Pakaian', 'description' => 'Berbagai macam pakaian pria dan wanita.'],
            ['name' => 'Makanan & Minuman', 'description' => 'Produk makanan dan minuman kemasan.'],
            ['name' => 'Peralatan Rumah Tangga', 'description' => 'Perabotan dan alat-alat rumah tangga.'],
            ['name' => 'Kosmetik', 'description' => 'Produk kecantikan dan perawatan kulit.'],
            ['name' => 'Olahraga', 'description' => 'Peralatan dan perlengkapan olahraga.'],
            ['name' => 'Buku & Alat Tulis', 'description' => 'Buku, alat tulis, dan keperluan kantor.'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name'        => $category['name'],
                'description' => $category['description'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
