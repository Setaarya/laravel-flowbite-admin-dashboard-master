<?php

namespace App\Services;

use App\Models\StockTransaction;

interface StockTransactionServiceInterface
{
    public function getAllTransactions();
    public function getTransactionById($id);
    public function createTransaction(array $data);
    public function updateTransaction(StockTransaction $stockTransaction, array $data);
    public function deleteTransaction(StockTransaction $stockTransaction);
}
