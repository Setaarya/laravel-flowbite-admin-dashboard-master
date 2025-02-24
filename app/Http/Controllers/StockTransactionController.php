<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\User;
use App\Services\StockTransactionServiceInterface;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    protected $stockTransactionService;

    public function __construct(StockTransactionServiceInterface $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    /**
     * Display a listing of the stock transactions.
     */
    public function index()
    {
        $transactions = $this->stockTransactionService->getAllStockTransactions();
        return view('stock_transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new stock transaction.
     */
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('stock_transactions.create', compact('products', 'users'));
    }

    /**
     * Store a newly created stock transaction in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->stockTransactionService->validateStockTransactionData($request);
        $this->stockTransactionService->createStockTransaction($validatedData);

        return redirect()->route('stock_transactions.index')->with('success', 'Stock transaction created successfully.');
    }

    /**
     * Display the specified stock transaction.
     */
    public function show(StockTransaction $stockTransaction)
    {
        return view('stock_transactions.show', compact('stockTransaction'));
    }

    /**
     * Show the form for editing the specified stock transaction.
     */
    public function edit(StockTransaction $stockTransaction)
    {
        $products = Product::all();
        $users = User::all();
        return view('stock_transactions.edit', compact('stockTransaction', 'products', 'users'));
    }

    /**
     * Update the specified stock transaction in storage.
     */
    public function update(Request $request, StockTransaction $stockTransaction)
    {
        $validatedData = $this->stockTransactionService->validateStockTransactionData($request);
        $this->stockTransactionService->updateStockTransaction($stockTransaction, $validatedData);

        return redirect()->route('stock_transactions.index')->with('success', 'Stock transaction updated successfully.');
    }

    /**
     * Remove the specified stock transaction from storage.
     */
    public function destroy(StockTransaction $stockTransaction)
    {
        $this->stockTransactionService->deleteStockTransaction($stockTransaction);

        return redirect()->route('stock_transactions.index')->with('success', 'Stock transaction deleted successfully.');
    }
}
