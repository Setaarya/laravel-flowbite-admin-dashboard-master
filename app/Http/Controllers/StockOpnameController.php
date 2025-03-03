<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Models\Product;

class StockOpnameController extends Controller
{
    public function index()
    {
        $stockData = StockTransaction::getStockSummary();
        return view('manager.stock_transactions.stock_opname', compact('stockData'));
    }

    public function updateStock(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'actual_stock' => 'required|integer|min:0'
        ]);

        $productId = $validatedData['product_id'];
        $actualStock = $validatedData['actual_stock'];

        $stock = StockTransaction::getStockSummary()->firstWhere('product_id', $productId);
        $calculatedStock = $stock ? ($stock->total_in - $stock->total_out) : 0;
        $difference = $actualStock - $calculatedStock;

        if ($difference != 0) {
            StockTransaction::create([
                'product_id' => $productId,
                'user_id' => auth()->id(),
                'type' => $difference > 0 ? 'masuk' : 'keluar',
                'quantity' => abs($difference),
                'date' => now(),
                'status' => ['received','dispatched'],
                'notes' => 'Stock adjustment from Stock Opname'
            ]);
        }

        return redirect()->back()->with('success', 'Stock updated successfully!');
    }
}
