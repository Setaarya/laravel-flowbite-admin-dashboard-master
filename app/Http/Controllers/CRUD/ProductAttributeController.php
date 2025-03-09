<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Services\ProductAttributeService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    protected $productAttributeService;
    protected $productService;

    public function __construct(ProductAttributeService $productAttributeService, ProductService $productService)
    {
        $this->productAttributeService = $productAttributeService;
        $this->productService = $productService;
    }

    public function index()
    {
        $attributes = $this->productAttributeService->getAllProductAttributes();
        return view('admin.product_attributes.index', compact('attributes'));
    }

    public function create()
    {
        $products = $this->productService->getAllProducts(); // Menggunakan service
        return view('admin.product_attributes.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->productAttributeService->validateProductAttributeData($request);
        $this->productAttributeService->createProductAttribute($validatedData);

        return redirect()->route('admin.product_attributes.index')->with('success', 'Product attribute created successfully.');
    }

    public function show($id)
    {
        $productAttribute = $this->productAttributeService->getProductAttributesById($id); // Menggunakan service
        return view('admin.product_attributes.show', compact('productAttribute'));
    }

    public function edit($id)
    {
        $products = $this->productService->getAllProducts(); // Menggunakan service
        $productAttribute = $this->productAttributeService->getProductAttributesById($id); // Menggunakan service
        return view('admin.product_attributes.edit', compact('products', 'productAttribute'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->productAttributeService->validateProductAttributeData($request);
        $this->productAttributeService->updateProductAttribute($id, $validatedData); // Menggunakan service

        return redirect()->route('admin.product_attributes.index')->with('success', 'Product attribute updated successfully.');
    }

    public function destroy($id)
    {
        $this->productAttributeService->deleteProductAttribute($id); // Menggunakan service
        return redirect()->route('admin.product_attributes.index')->with('success', 'Product attribute deleted successfully.');
    }
}
