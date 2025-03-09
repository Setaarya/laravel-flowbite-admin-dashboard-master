<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all(); // Tetap butuh Model untuk query database
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);
        return $category->update($data);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
