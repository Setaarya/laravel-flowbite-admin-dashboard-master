<?php

namespace App\Repositories;

use App\Models\StockTransaction;

interface StockTransactionRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(StockTransaction $stockTransaction, array $data);
    public function delete(StockTransaction $stockTransaction);
    public function getPending();
    public function updateStatus($id, $status);
}
