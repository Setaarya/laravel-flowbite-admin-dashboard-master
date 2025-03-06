<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::with('category', 'supplier')->get();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        // Jika ada gambar, simpan ke storage
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return Product::create($data);
    }


    public function update(Product $product, array $data)
    {
        if (isset($data['image'])) {
            $newImagePath = $this->uploadImage($data['image']);

            if ($newImagePath) {
                $this->deleteImage($product->image);
                $data['image'] = $newImagePath;
            }
        }

        return $product->update($data);
    }

    /**
     * Hapus produk
     */
    public function delete(Product $product)
    {
        // Hapus gambar produk jika ada sebelum menghapus produk
        $this->deleteImage($product->image);
        
        return $product->delete();
    }

    /**
     * Upload gambar produk ke storage
     */
    private function uploadImage($image)
    {
        Storage::disk('public')->makeDirectory('products'); // Pastikan folder ada
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        return $image->storeAs('products', $filename, 'public');
    }

    /**
     * Hapus gambar dari storage jika ada
     */
    private function deleteImage($imagePath)
    {
        if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

}
