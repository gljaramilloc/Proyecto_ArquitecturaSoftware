<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\TogglesActiveStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    use TogglesActiveStatus;

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Manage Categories - Online Store';
        $viewData['categories'] = Category::with('status')->get();

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Category - Online Store';
        $viewData['statuses'] = Status::all();

        return view('admin.categories.create')->with('viewData', $viewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')->with('status', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        $viewData = [];
        $viewData['title'] = 'Edit Category - Online Store';
        $viewData['category'] = $category;
        $viewData['statuses'] = Status::all();

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully.');
    }

    public function toggleStatus(Category $category): RedirectResponse
    {
        return $this->toggleModelStatus($category, 'admin.categories.index');
    }
}
