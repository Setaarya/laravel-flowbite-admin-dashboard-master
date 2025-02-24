<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\StockTransaction;

interface StockTransactionServiceInterface
{
    public function getAllStockTransactions();
    public function createStockTransaction(array $data);
    public function updateStockTransaction(StockTransaction $stockTransaction, array $data);
    public function deleteStockTransaction(StockTransaction $stockTransaction);
    public function validateStockTransactionData(Request $request);
}
