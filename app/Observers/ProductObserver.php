<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\StockOpname;

class ProductObserver
{
    public function created(Product $product)
    {
        StockOpname::create([
            'category_id'   => $product->category_id,
            'supplier_id'   => $product->supplier_id,
            'product_id'    => $product->id,
            'manual_count'  => $product->current_stock, // Default manual count = current stock
            'status'        => 'Balanced (0)',
        ]);
    }
}
