<?php

namespace App\Services;

use App\Repositories\ProductAttributeRepositoryInterface;
use Illuminate\Http\Request;

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

    public function getProductAttributesById($id)
    {
        return $this->productAttributeRepository->getById($id);
    }

    public function createProductAttribute(array $data)
    {

        return $this->productAttributeRepository->create($data);
    }

    public function updateProductAttribute($id, array $data)
    {
        return $this->productAttributeRepository->update($id, $data);
    }

    public function deleteProductAttribute($id)
    {
        return $this->productAttributeRepository->delete($id);
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
