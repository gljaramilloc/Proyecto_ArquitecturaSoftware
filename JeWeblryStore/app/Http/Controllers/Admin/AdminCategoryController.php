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
        $viewData['title'] = __('admin.manage_categories');
        $viewData['categories'] = Category::with('status')->get();

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.create_category');
        $viewData['statuses'] = Status::all();

        return view('admin.categories.create')->with('viewData', $viewData);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')->with('status', __('admin.category_created'));
    }

    public function edit(int $id): View
    {
        $category = Category::findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('admin.edit_category');
        $viewData['category'] = $category;
        $viewData['statuses'] = Status::all();

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    public function update(UpdateCategoryRequest $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('status', __('admin.category_updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', __('admin.category_deleted'));
    }

    public function toggleStatus(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        return $this->toggleModelStatus($category, 'admin.categories.index');
    }
}
