<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffDashboardRepository implements StaffDashboardRepositoryInterface
{
    public function getPendingIncomingStock(): Collection
    {
        return StockTransaction::where('type', 'masuk')->where('status', 'pending')->get();
    }

    public function getPendingOutgoingStock(): Collection
    {
        return StockTransaction::where('type', 'keluar')->where('status', 'pending')->get();
    }

    public function getReceivedStock(): Collection
    {
        return StockTransaction::where('type', 'masuk')->where('status', 'received')->get();
    }

    public function getDispatchedStock(): Collection
    {
        return StockTransaction::where('type', 'keluar')->where('status', 'dispatched')->get();
    }

    public function getLowStockItems(): Collection
    {
        return DB::table('products')
            ->where('stock', '<', 'minimum_stock')
            ->get();
    }

    public function itemsInToday(): Collection
    {
        return StockTransaction::with('product')
            ->where('type', 'masuk')
            ->whereDate('date', Carbon::today())
            ->get();
    }

    public function itemsOutToday(): Collection
    {
        return StockTransaction::with('product')
            ->where('type', 'keluar')
            ->whereDate('date', Carbon::today())
            ->get();
    }
}
