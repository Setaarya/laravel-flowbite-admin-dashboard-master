<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;

class DashboardRepository
{
    public function getSummary()
    {
        return [
            'total_products' => Product::count(),
            'total_transactions' => StockTransaction::count(),
            'total_suppliers' => Supplier::count(),
            'total_users' => User::count(),
            'low_stock' => Product::where('sku', '<=', 30)->count(), // Produk dengan stok rendah (<= 10)
        ];
    }
}
