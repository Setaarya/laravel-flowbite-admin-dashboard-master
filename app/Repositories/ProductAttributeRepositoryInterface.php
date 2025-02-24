<?php

namespace App\Repositories;

use App\Models\ProductAttribute;

interface ProductAttributeRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(ProductAttribute $productAttribute, array $data);
    public function delete(ProductAttribute $productAttribute);
}
