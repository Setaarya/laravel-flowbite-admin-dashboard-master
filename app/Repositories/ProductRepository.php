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
        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if (isset($data['image'])) {
            $this->deleteImage($product->image);
            $data['image'] = $this->uploadImage($data['image']);
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
        return $image->store('products', 'public');
    }

    /**
     * Hapus gambar dari storage jika ada
     */
    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

}
