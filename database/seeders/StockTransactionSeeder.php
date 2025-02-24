<?php

namespace Database\Seeders;

use App\Models\StockTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class StockTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'product_id' => 1,
                'user_id'    => 445566,
                'type'       => 'masuk',
                'quantity'   => 50,
                'date'       => '2025-02-20',
                'status'     => 'received',
                'notes'      => 'Pengisian stok awal',
            ],
            [
                'product_id' => 2,
                'user_id'    => 445567,
                'type'       => 'keluar',
                'quantity'   => 20,
                'date'       => '2025-02-21',
                'status'     => 'dispatched',
                'notes'      => 'Pesanan pelanggan A',
            ],
            [
                'product_id' => 3,
                'user_id'    => 445568,
                'type'       => 'masuk',
                'quantity'   => 30,
                'date'       => '2025-02-22',
                'status'     => 'pending',
                'notes'      => 'Menunggu konfirmasi pemasok',
            ],
            [
                'product_id' => 1,
                'user_id'    => 445569,
                'type'       => 'keluar',
                'quantity'   => 15,
                'date'       => '2025-02-23',
                'status'     => 'dispatched',
                'notes'      => 'Dikirim ke toko cabang',
            ],
            [
                'product_id' => 4,
                'user_id'    => 4455666,
                'type'       => 'masuk',
                'quantity'   => 60,
                'date'       => '2025-02-24',
                'status'     => 'received',
                'notes'      => 'Restock produk dari supplier',
            ],
        ];

        foreach ($transactions as $transaction) {
            DB::table('stock_transactions')->insert([
                'product_id' => $transaction['product_id'],
                'user_id'    => $transaction['user_id'],
                'type'       => $transaction['type'],
                'quantity'   => $transaction['quantity'],
                'date'       => $transaction['date'],
                'status'     => $transaction['status'],
                'notes'      => $transaction['notes'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
