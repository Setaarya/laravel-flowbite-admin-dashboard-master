<?php

namespace App\Repositories;

use App\Models\StockOpname;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StockOpnameRepository implements StockOpnameRepositoryInterface
{
    public function getAllStockOpname()
    {
        return StockOpname::select(
            'stock_opname.id',
            'products.name as product_name',
            'categories.name as category',
            'products.sku',
            'products.current_stock',
            'products.minimum_stock',
            'stock_opname.manual_count',
            'stock_opname.status'
        )
        ->join('products', 'stock_opname.product_id', '=', 'products.id')
        ->join('categories', 'stock_opname.category_id', '=', 'categories.id')
        ->orderBy('products.name')
        ->get();
    }

    public function updateManualCount($id, $manualCount)
    {
        $stockOpname = StockOpname::findOrFail($id);
        $currentStock = $stockOpname->product->current_stock;

        // Hitung status berdasarkan perbedaan stok
        $difference = $manualCount - $currentStock;
        $status = $difference > 0 ? "Surplus (+$difference)" : ($difference < 0 ? "Minus ($difference)" : "Balanced (0)");

        // Simpan ke database
        $stockOpname->update([
            'manual_count' => $manualCount,
            'status' => $status
        ]);

        return $stockOpname;
    }

    public function findById($id)
    {
        return StockOpname::find($id);
    }

    public function saveStockOpname($stockData)
    {
        foreach ($stockData as $data) {
            $stockOpname = $this->findById($data['product_id']);
            if ($stockOpname) {
                $stockOpname->manual_count = $data['manual_count'];
                $stockOpname->status = $data['status'];
                $stockOpname->save();
            }
        }
    }

    public function getLatestStockOpname()
    {
        return StockOpname::latest()->get();
    }

    public function adjustStock($id, $adjustmentValue)
    {
        $stockOpname = StockOpname::findOrFail($id);
        $product = Product::findOrFail($stockOpname->product_id);

        // Update nilai current_stock di tabel products
        $product->current_stock = $adjustmentValue;
        $product->save();

        // Update manual_count dan status di tabel stock_opname
        $stockOpname->manual_count = $adjustmentValue;
        $stockOpname->status = $this->calculateStatus($product->current_stock, $adjustmentValue);
        $stockOpname->save();

        return $stockOpname;
    }

    private function calculateStatus($currentStock, $manualCount)
    {
        $difference = $manualCount - $currentStock;
        if ($difference > 0) {
            return "Surplus (+$difference)";
        } elseif ($difference < 0) {
            return "Minus ($difference)";
        } else {
            return "Balanced (0)";
        }
    }

    public function getLatestStockOpnameAdmin()
    {
        return StockOpname::with(['product', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
?>