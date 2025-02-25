<?php

namespace App\Http\Controllers;

use App\Services\ProductAttributeService;
use App\Models\ProductAttribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    protected $productAttributeService;

    public function __construct(ProductAttributeService $productAttributeService)
    {
        $this->productAttributeService = $productAttributeService;
    }

    public function index()
    {
        $attributes = $this->productAttributeService->getAllProductAttributes();
        return view('product_attributes.index', compact('attributes'));
    }

    public function create()
    {
        $products = Product::all(); // Ambil semua produk
        return view('product_attributes.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->productAttributeService->validateProductAttributeData($request);
        $this->productAttributeService->createProductAttribute($validatedData);

        return redirect()->route('product_attributes.index')->with('success', 'Product attribute created successfully.');
    }

    public function show(ProductAttribute $productAttribute)
    {
        return view('product_attributes.show', compact('productAttribute'));
    }

    public function edit(ProductAttribute $productAttribute)
    {
        $products = Product::all(); // Ambil semua produk
        return view('product_attributes.edit', compact('products', 'productAttribute'));
    }

    public function update(Request $request, ProductAttribute $productAttribute)
    {
        $validatedData = $this->productAttributeService->validateProductAttributeData($request);
        $this->productAttributeService->updateProductAttribute($productAttribute, $validatedData);

        return redirect()->route('product_attributes.index')->with('success', 'Product attribute updated successfully.');
    }

    public function destroy(ProductAttribute $productAttribute)
    {
        $this->productAttributeService->deleteProductAttribute($productAttribute);

        return redirect()->route('product_attributes.index')->with('success', 'Product attribute deleted successfully.');
    }
}
