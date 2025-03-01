<?php

namespace App\Repositories;


use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;

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
}
