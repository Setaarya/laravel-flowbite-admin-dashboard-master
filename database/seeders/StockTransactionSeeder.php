<?php

namespace Database\Seeders;

use App\Models\StockTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;


class StockTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Pastikan ada data di tabel users dan products
        $userIds = DB::table('users')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        if (empty($userIds) || empty($productIds)) {
            $this->command->warn('Tabel Users atau Products kosong! Pastikan telah menjalankan seeder untuk tabel tersebut.');
            return;
        }

        foreach (range(1, 10) as $index) {
            DB::table('stock_transactions')->insert([
                'product_id' => $faker->randomElement($productIds),
                'user_id'    => $faker->randomElement($userIds),
                'type'       => $faker->randomElement(['masuk', 'keluar']),
                'quantity'   => $faker->numberBetween(10, 100),
                'date'       => $faker->date('Y-m-d'),
                'status'     => $faker->randomElement(['pending', 'received', 'dispatched']),
                'notes'      => $faker->sentence,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
