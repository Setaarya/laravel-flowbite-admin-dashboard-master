<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;

class StockOpnameRepository implements StockOpnameRepositoryInterface
{
    public function getStockOpnameData()
    {
        return Product::select(
            'products.id',
            'products.name',
            'categories.name as category',
            'products.sku',
            'products.current_stock',
            'products.minimum_stock',
            DB::raw('(SELECT SUM(quantity) FROM stock_transactions WHERE stock_transactions.product_id = products.id AND stock_transactions.type = "masuk") as total_in'),
            DB::raw('(SELECT SUM(quantity) FROM stock_transactions WHERE stock_transactions.product_id = products.id AND stock_transactions.type = "keluar") as total_out')
        )
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->get();
    }

    public function updateStockOpname($productId, $manualCount)
    {
        $product = Product::findOrFail($productId);
        $difference = $manualCount - $product->current_stock;

        $product->update(['current_stock' => $manualCount]);

        return $difference;
    }
}
