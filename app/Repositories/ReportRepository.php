<?php

namespace App\Repositories;


use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ReportRepository
{
    public function getReport($categoryId = null, $startDate = null, $endDate = null)
    {
        $query = StockTransaction::select(
            'products.id',
            'products.name as product_name',
            'categories.id as category_id',
            'categories.name as category_name',
            'suppliers.id as supplier_id',
            'suppliers.name as supplier_name',
            'products.sku',
            'products.purchase_price',
            'products.selling_price',
            'products.current_stock',
            'stock_transactions.type',
            DB::raw('SUM(stock_transactions.quantity) as total_quantity'),
            DB::raw('IF(stock_transactions.type = "keluar", SUM(stock_transactions.quantity * products.selling_price), 0) as total_selling_price'),
            DB::raw('IF(stock_transactions.type = "masuk", SUM(stock_transactions.quantity * products.purchase_price), 0) as total_purchasing_price'),
            'stock_transactions.date'
        )
        ->join('products', 'stock_transactions.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
        ->groupBy(
            'products.id', 'products.name', 
            'categories.id', 'categories.name',
            'suppliers.id', 'suppliers.name',
            'products.sku', 'products.purchase_price', 'products.selling_price', 'products.current_stock',
            'stock_transactions.type', 'stock_transactions.date'
        );        

        // Filter berdasarkan kategori
        if ($categoryId) {
            $query->where('products.category_id', $categoryId);
        }

        // Filter berdasarkan periode
        if ($startDate && $endDate) {
            $query->whereBetween('stock_transactions.date', [$startDate, $endDate]);
        }

        return $query->get();
    }

    public function getFilteredProducts($filters)
    {
        $query = Product::query()
            ->select([
                'products.id',
                'products.name as product_name',
                'categories.name as category_name',
                'suppliers.name as supplier_name',
                'products.sku',
                'products.purchase_price',
                'products.selling_price',
                'products.current_stock',
                'products.minimum_stock',
                DB::raw("(SELECT GROUP_CONCAT(CONCAT(product_attributes.name, ': ', product_attributes.value) SEPARATOR ', ') 
                          FROM product_attributes 
                          WHERE product_attributes.product_id = products.id) as attributes"),
                DB::raw("(SELECT SUM(quantity) FROM stock_transactions WHERE stock_transactions.product_id = products.id AND type = 'masuk') as total_in"),
                DB::raw("(SELECT SUM(quantity) FROM stock_transactions WHERE stock_transactions.product_id = products.id AND type = 'keluar') as total_out")
            ])
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id');

        // Terapkan filter
        if (!empty($filters['category_id'])) {
            $query->where('products.category_id', $filters['category_id']);
        }
        if (!empty($filters['supplier_id'])) {
            $query->where('products.supplier_id', $filters['supplier_id']);
        }
        if (!empty($filters['stock_order'])) {
            $query->orderBy('products.current_stock', $filters['stock_order']);
        }
        if (!empty($filters['price_order'])) {
            $query->orderBy('products.selling_price', $filters['price_order']);
        }
        if (!empty($filters['transaction_order'])) {
            $query->orderBy(DB::raw("COALESCE(total_in, 0) + COALESCE(total_out, 0)"), $filters['transaction_order']);
        }

        return $query->get();
    }
}
