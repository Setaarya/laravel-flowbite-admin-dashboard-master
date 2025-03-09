<?php

namespace App\Repositories;

use App\Models\StockTransaction;

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

    public function update($id, array $data)
    {
        return StockTransaction::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return StockTransaction::where('id', $id)->delete();
    }

    public function getPending()
    {
        return StockTransaction::where('status', 'pending')->get();
    }

    public function updateStatus($id, $status)
    {
        return StockTransaction::where('id', $id)->update(['status' => $status]);
    }

    public function getByIdWithRelations($id)
    {
        return StockTransaction::with(['product', 'user'])->findOrFail($id);
    }

}
