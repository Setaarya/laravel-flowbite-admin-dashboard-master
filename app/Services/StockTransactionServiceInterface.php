<?php

namespace App\Services;

use App\Models\StockTransaction;
use Illuminate\Http\Request;

interface StockTransactionServiceInterface
{
    public function getAllTransactions();
    public function getAllTransactionsSortedByDate();
    public function getTransactionById($id);
    public function createTransaction(array $data);
    public function updateTransaction(StockTransaction $stockTransaction, array $data);
    public function deleteTransaction(StockTransaction $stockTransaction);
    public function getPendingTransactions();
    public function confirmTransaction($id, $status);
    public function createStockTransaction($userId, $data);
    public function validateStockTransactionData(Request $request);
}
