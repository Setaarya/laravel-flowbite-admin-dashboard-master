<?php

namespace App\Services;

use App\Repositories\StockTransactionRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class StockTransactionService
{
    protected $stockTransactionRepository;
    protected $productRepository;

    public function __construct(
        StockTransactionRepositoryInterface $stockTransactionRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->stockTransactionRepository = $stockTransactionRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllTransactions()
    {
        return $this->stockTransactionRepository->getAll();
    }

    public function getAllTransactionsSortedByDate()
    {
        return $this->stockTransactionRepository->getAllSortedByDate();
    }

    public function getTransactionById($transactionId)
    {
        return $this->stockTransactionRepository->getById($transactionId);
    }

    public function getTransactionWithRelations($id)
    {
        return $this->stockTransactionRepository->getByIdWithRelations($id);
    }

    public function createTransaction(array $data)
    {
        return $this->stockTransactionRepository->create($data);
    }

    public function updateTransaction($transactionId, array $data)
    {
        return $this->stockTransactionRepository->update($transactionId, $data);
    }

    public function deleteTransaction($transactionId)
    {
        return $this->stockTransactionRepository->delete($transactionId);
    }

    public function getPendingTransactions()
    {
        return $this->stockTransactionRepository->getPending();
    }

    public function confirmTransaction($transactionId, $status)
    {
        $transaction = $this->stockTransactionRepository->getById($transactionId);
        $product = $this->productRepository->getById($transaction->product_id);

        if ($status === 'received' && $transaction->type === 'masuk') {
            $this->productRepository->update($product->id, [
                'current_stock' => $product->current_stock + $transaction->quantity
            ]);
        } elseif ($status === 'dispatched' && $transaction->type === 'keluar') {
            if ($product->current_stock < $transaction->quantity) {
                throw new \Exception("Stok tidak cukup untuk transaksi ini.");
            }
            $this->productRepository->update($product->id, [
                'current_stock' => $product->current_stock - $transaction->quantity
            ]);
        }

        return $this->stockTransactionRepository->updateStatus($transactionId, $status);
    }

    public function createStockTransaction($userId, array $data)
    {
        return $this->stockTransactionRepository->create([
            'product_id' => $data['product_id'],
            'user_id' => $userId,
            'type' => $data['type'],
            'quantity' => $data['quantity'],
            'date' => $data['date'],
            'status' => 'pending',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    public function validateStockTransactionData(Request $request)
    {
        return $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    }
}
