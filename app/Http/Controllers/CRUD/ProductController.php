<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\ProductAttributeService;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $productAttributeService;

    public function __construct(ProductService $productService, ProductAttributeService $productAttributeService)
    {
        $this->productService = $productService;
        $this->productAttributeService = $productAttributeService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->productService->validateProductData($request);
        $this->productService->createProduct($validatedData);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $attributes = $this->productAttributeService->getAllProductAttributes()->where('product_id', $product->id);
        
        return view('products.show', compact('product', 'attributes'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $this->productService->validateProductData($request);
        $this->productService->updateProduct($product, $validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
