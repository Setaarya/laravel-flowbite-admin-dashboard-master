<?php

namespace App\Repositories;

use App\Models\StockTransaction;

class StockTransactionRepository implements StockTransactionRepositoryInterface
{
    public function getAll()
    {
        return StockTransaction::with('product', 'user')->get();
    }

    public function getById($id)
    {
        return StockTransaction::with('product', 'user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return StockTransaction::create($data);
    }

    public function update(StockTransaction $stockTransaction, array $data)
    {
        return $stockTransaction->update($data);
    }

    public function delete(StockTransaction $stockTransaction)
    {
        return $stockTransaction->delete();
    }
}
