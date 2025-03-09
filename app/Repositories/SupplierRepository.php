<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getAll()
    {
        return Supplier::all();
    }

    public function getById($id)
    {
        return Supplier::findOrFail($id);
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function update($id, array $data)
    {
        return Supplier::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Supplier::where('id', $id)->delete();
    }
}
