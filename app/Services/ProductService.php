<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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

    public function updateProduct(Product $product, array $data)
    {
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product)
    {
        return $this->productRepository->delete($product);
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
            'current_stock'  => 'nullable|integer|min:0',  // Ditambahkan agar sesuai database
            'minimum_stock'  => 'required|integer|min:0',
        ]);
    }
}
