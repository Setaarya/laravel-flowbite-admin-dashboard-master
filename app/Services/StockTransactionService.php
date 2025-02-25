<?php

namespace App\Services;

use App\Repositories\StockTransactionRepositoryInterface;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockTransactionService implements StockTransactionServiceInterface
{
    protected $repository;

    public function __construct(StockTransactionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTransactions()
    {
        return $this->repository->getAll();
    }

    public function getTransactionById($id)
    {
        return $this->repository->getById($id);
    }

    public function createTransaction(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTransaction(StockTransaction $stockTransaction, array $data)
    {
        return $this->repository->update($stockTransaction, $data);
    }

    public function deleteTransaction(StockTransaction $stockTransaction)
    {
        return $this->repository->delete($stockTransaction);
    }

    public function getPendingTransactions()
    {
        return StockTransaction::where('status', 'pending')->get();
    }

    public function confirmTransaction($id, $status)
    {
        $transaction = StockTransaction::findOrFail($id);
        $transaction->update(['status' => $status]);
    }

    public function createStockTransaction($userId, $data)
    {
        return StockTransaction::create([
            'product_id' => $data['product_id'],
            'user_id' => $userId,
            'type' => $data['type'],
            'quantity' => $data['quantity'],
            'date' => $data['date'],
            'status' => 'pending', // Status selalu 'pending' saat dibuat
            'notes' => $data['notes'] ?? null,
        ]);
    }

    public function validateStockTransactionData(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    }
}
