<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->categoryService->validateCategoryData($request);
        $this->categoryService->createCategory($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->categoryService->validateCategoryData($request);
        $this->categoryService->updateCategory($id, $validatedData);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function adminindex()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }
}
