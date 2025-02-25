<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'user'])->latest()->get();
        return view('stock_transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'manager') {
            return redirect()->route('stock_transactions.index')->with('error', 'Unauthorized.');
        }

        $products = Product::all();
        return view('stock_transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'manager') {
            return redirect()->route('stock_transactions.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        StockTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('stock_transactions.index')->with('success', 'Stock transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockTransaction $stockTransaction)
    {
        return view('stock_transactions.show', compact('stockTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockTransaction $stockTransaction)
    {
        if (Auth::user()->role !== 'staff') {
            return redirect()->route('stock_transactions.index')->with('error', 'Unauthorized.');
        }

        return view('stock_transactions.edit', compact('stockTransaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockTransaction $stockTransaction)
    {
        if (Auth::user()->role !== 'staff') {
            return redirect()->route('stock_transactions.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'status' => 'required|in:received,dispatched',
        ]);

        $stockTransaction->update([
            'status' => $request->status,
        ]);

        return redirect()->route('stock_transactions.index')->with('success', 'Stock transaction updated successfully.');
    }
}
