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

    public function update(ProductAttribute $productAttribute, array $data)
    {
        return $productAttribute->update($data);
    }

    public function delete(ProductAttribute $productAttribute)
    {
        return $productAttribute->delete();
    }
}
