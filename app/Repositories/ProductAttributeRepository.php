<?php

namespace App\Repositories;

use App\Models\ProductAttribute;

class ProductAttributeRepository implements ProductAttributeRepositoryInterface
{
    public function getAll()
    {
        return ProductAttribute::with('product')->get();
    }

    public function getById($id)
    {
        return ProductAttribute::with('product')->findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductAttribute::create($data);
    }

    public function update($id, array $data)
    {
        $productAttribute = ProductAttribute::findOrfail($id);
        return $productAttribute->update($data);
    }

    public function delete($id)
    {
        $productAttribute = ProductAttribute::findOrfail($id);
        return $productAttribute->delete();
    }
}
