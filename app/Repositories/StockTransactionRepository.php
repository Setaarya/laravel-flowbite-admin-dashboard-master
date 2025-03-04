<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;



class StockTransactionRepository implements StockTransactionRepositoryInterface
{
    public function getAll()
    {
        return StockTransaction::with('product', 'user')->get();
    }

    public function getAllSortedByDate()
    {
        return StockTransaction::with('product', 'user')->orderBy('date', 'desc')->get();
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

    public function getPending()
    {
        return StockTransaction::where('status', 'pending')->get();
    }

    public function updateStatus($id, $status)
    {
        return StockTransaction::where('id', $id)->update(['status' => $status]);
    }
    
}
