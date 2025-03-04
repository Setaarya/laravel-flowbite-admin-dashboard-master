<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\ProductAttributeService;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Response;

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
        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->productService->validateProductData($request);
        $this->productService->createProduct($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $attributes = $this->productAttributeService->getAllProductAttributes()->where('product_id', $product->id);
        
        return view('admin.products.show', compact('product', 'attributes'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $this->productService->validateProductData($request);
        $this->productService->updateProduct($product, $validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function managerIndex()
    {
        $products = $this->productService->getAllProducts();
        return view('manager.products.index', compact('products'));
    }

    // Menampilkan detail produk untuk manajer
    public function managerShow(Product $product)
    {
        $attributes = $this->productAttributeService->getAllProductAttributes()->where('product_id', $product->id);
        
        return view('manager.products.show', compact('product', 'attributes'));
        
    }

    public function adminIndex()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.products.index', compact('products'));
    }

    public function export()
    {
        // Ambil data dari database
        $products = Product::with(['category', 'supplier'])->get();

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header untuk file Excel
        $headers = [
            'ID', 'Kategori', 'Supplier', 'Nama Produk', 'SKU', 'Deskripsi', 
            'Harga Beli', 'Harga Jual', 'Gambar', 'Stok Saat Ini', 'Stok Minimum', 'Dibuat Pada'
        ];

        // Isi header pada row pertama
        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $column++;
        }

        // Isi data produk mulai dari baris ke-2
        $row = 2;
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->id);
            $sheet->setCellValue('B' . $row, $product->category->name ?? 'Tidak Ada');
            $sheet->setCellValue('C' . $row, $product->supplier->name ?? 'Tidak Ada');
            $sheet->setCellValue('D' . $row, $product->name);
            $sheet->setCellValue('E' . $row, $product->sku);
            $sheet->setCellValue('F' . $row, $product->description);
            $sheet->setCellValue('G' . $row, $product->purchase_price);
            $sheet->setCellValue('H' . $row, $product->selling_price);
            $sheet->setCellValue('I' . $row, $product->image);
            $sheet->setCellValue('J' . $row, $product->current_stock);
            $sheet->setCellValue('K' . $row, $product->minimum_stock);
            $sheet->setCellValue('L' . $row, $product->created_at);
            $row++;
        }

        // Simpan ke dalam file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'products_export.xlsx';

        // Simpan ke penyimpanan sementara dan kirimkan sebagai response
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}

