<?php

namespace App\Services;

use App\Repositories\StockTransactionRepositoryInterface;
use App\Models\StockTransaction;

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
}
