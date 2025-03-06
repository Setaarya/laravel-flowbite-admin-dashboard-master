<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\UserActivity;

class AdminDashboardRepository implements AdminDashboardRepositoryInterface
{
    public function getTotalProducts(): int
    {
        return Product::count();
    }

    public function getIncomingTransactions(): int
    {
        return StockTransaction::where('type', 'masuk')->count();
    }

    public function getOutgoingTransactions(): int
    {
        return StockTransaction::where('type', 'keluar')->count();
    }

    public function getTotalTransactions(): int
    {
        return StockTransaction::count();
    }

    public function getTotalSuppliers(): int
    {
        return Supplier::count();
    }

    public function getTotalUsers(): int
    {
        return User::count();
    }

    public function getLowStockCount(): int
    {
        return Product::where('current_stock', '<=', 'minimun_stock')->count();
    }

    public function getLatestUserActivities(int $limit = 10)
    {
        return UserActivity::with('user') // Pastikan relasi user dimuat
        ->latest() // Ambil data terbaru duluan
        ->paginate($limit); // Gunakan parameter limit untuk paginasi
    }

    public function getStockLevels()
    {
        return Product::select('name', 'current_stock')->get();
    }
}

