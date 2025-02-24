<?php

namespace App\Services;

use App\Repositories\ProductAttributeRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;

class ProductAttributeService
{
    protected $productAttributeRepository;

    public function __construct(ProductAttributeRepositoryInterface $productAttributeRepository)
    {
        $this->productAttributeRepository = $productAttributeRepository;
    }

    public function getAllProductAttributes()
    {
        return $this->productAttributeRepository->getAll();
    }

    public function createProductAttribute(array $data)
    {
        return $this->productAttributeRepository->create($data);
    }

    public function updateProductAttribute(ProductAttribute $productAttribute, array $data)
    {
        return $this->productAttributeRepository->update($productAttribute, $data);
    }

    public function deleteProductAttribute(ProductAttribute $productAttribute)
    {
        return $this->productAttributeRepository->delete($productAttribute);
    }

    public function validateProductAttributeData(Request $request)
    {
        return $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);
    }
}
