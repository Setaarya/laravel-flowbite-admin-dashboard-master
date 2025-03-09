<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProductsWithRelations()
    {
        return $this->productRepository->getAllWithRelations();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function createProduct(array $data)
    {
        if (!isset($data['current_stock'])) {
            $data['current_stock'] = 0;
        }
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    public function validateProductData(Request $request)
    {
        return $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|max:255|unique:products,sku,' . $request->route('product'),
            'description'    => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'current_stock'  => 'nullable|integer|min:0',
            'minimum_stock'  => 'required|integer|min:0',
        ]);
    }
}
