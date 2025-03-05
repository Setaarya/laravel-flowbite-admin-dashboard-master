<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use App\Models\Product;
use Carbon\Carbon;

class ManagerDashboardRepository
{
    public function getLowStockProducts()
    {
        return Product::where('current_stock', '<=', 'minimum_stock')->get();
    }

    public function getIncomingStockToday()
    {
        return StockTransaction::where('type', 'masuk')
            ->whereDate('created_at', Carbon::today())
            ->get();
    }

    public function getOutgoingStockToday()
    {
        return StockTransaction::where('type', 'keluar')
            ->whereDate('created_at', Carbon::today())
            ->get();
    }
}
