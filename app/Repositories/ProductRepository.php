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
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);

        if (isset($data['image'])) {
            $newImagePath = $this->uploadImage($data['image']);

            if ($newImagePath) {
                $this->deleteImage($product->image);
                $data['image'] = $newImagePath;
            }
        }

        return $product->update($data);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $this->deleteImage($product->image);

        return $product->delete();
    }

    private function uploadImage($image)
    {
        Storage::disk('public')->makeDirectory('products');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        return $image->storeAs('products', $filename, 'public');
    }

    private function deleteImage($imagePath)
    {
        if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    public function getAllWithRelations()
    {
        return Product::with(['category', 'supplier'])->get();
    }
}
