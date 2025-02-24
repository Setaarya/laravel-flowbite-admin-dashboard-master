<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('suppliers')->insert([
                'name'       => $faker->company,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->phoneNumber,
                'address'    => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}