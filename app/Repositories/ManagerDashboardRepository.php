<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use App\Models\Product;
use Carbon\Carbon;

class ManagerDashboardRepository
{
    public function getLowStockProducts($threshold = 10)
    {
        return Product::where('current_stock', '<=', $threshold)->get();
    }

    public function getIncomingStockToday()
    {
        return StockTransaction::where('type', 'in')
            ->whereDate('created_at', Carbon::today())
            ->get();
    }

    public function getOutgoingStockToday()
    {
        return StockTransaction::where('type', 'out')
            ->whereDate('created_at', Carbon::today())
            ->get();
    }
}
