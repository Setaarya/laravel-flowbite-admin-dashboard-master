<?php

namespace App\Repositories;

use App\Models\Supplier;

interface SupplierRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(Supplier $supplier, array $data);
    public function delete(Supplier $supplier);
}

