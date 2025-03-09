<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;


class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function validateCategoryData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $request->id,
            'description' => 'nullable|string',
        ]);
    }
}
