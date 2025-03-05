<?php

namespace App\Observers;

use App\Models\StockTransaction;
use App\Models\StockOpname;

class StockTransactionObserver
{
    public function created(StockTransaction $transaction)
    {
        // Cari data stock opname berdasarkan product_id
        $stockOpname = StockOpname::where('product_id', $transaction->product_id)->first();

        if ($stockOpname) {
            // Update current stock sesuai transaksi (masuk atau keluar)
            if ($transaction->type === 'in') {
                $stockOpname->current_stock += $transaction->quantity;
            } elseif ($transaction->type === 'out') {
                $stockOpname->current_stock -= $transaction->quantity;
            }

            // Hitung ulang status berdasarkan selisih stok
            $difference = $stockOpname->manual_count - $stockOpname->current_stock;
            if ($difference > 0) {
                $stockOpname->status = "Surplus (+{$difference})";
            } elseif ($difference < 0) {
                $stockOpname->status = "Minus ({$difference})";
            } else {
                $stockOpname->status = "Balanced (0)";
            }

            // Simpan perubahan
            $stockOpname->save();
        }
    }
}
