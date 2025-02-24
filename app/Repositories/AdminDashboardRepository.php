<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdminDashboardRepository implements AdminDashboardRepositoryInterface
{
    public function getTotalProducts(): int
    {
        return Product::count();
    }

    public function getTransactionsCount($startDate, $endDate, $type): int
    {
        return StockTransaction::where('type', $type)
            ->whereBetween('date', [$startDate, $endDate])
            ->count();
    }

    public function getStockLevels(): Collection
    {
        return DB::table('products')
            ->select('name', 'stock')
            ->get();
    }

    public function getLatestUserActivities(): Collection
    {
        return User::latest()->limit(10)->get();
    }
}
