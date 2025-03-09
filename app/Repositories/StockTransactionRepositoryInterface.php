<?php

namespace App\Repositories;

use App\Models\StockTransaction;

interface StockTransactionRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getAllSortedByDate();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getPending();
    public function updateStatus($id, $status);
    public function getByIdWithRelations($id);
}
