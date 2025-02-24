<?php

namespace App\Services;

use App\Repositories\StockTransactionRepositoryInterface;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class StockTransactionService implements StockTransactionServiceInterface
{
    protected $stockTransactionRepository;

    public function __construct(StockTransactionRepositoryInterface $stockTransactionRepository)
    {
        $this->stockTransactionRepository = $stockTransactionRepository;
    }

    public function getAllStockTransactions()
    {
        return $this->stockTransactionRepository->getAll();
    }

    public function createStockTransaction(array $data)
    {
        return $this->stockTransactionRepository->create($data);
    }

    public function updateStockTransaction(StockTransaction $stockTransaction, array $data)
    {
        return $this->stockTransactionRepository->update($stockTransaction, $data);
    }

    public function deleteStockTransaction(StockTransaction $stockTransaction)
    {
        return $this->stockTransactionRepository->delete($stockTransaction);
    }

    public function validateStockTransactionData(Request $request)
    {
        return $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);
    }
}
