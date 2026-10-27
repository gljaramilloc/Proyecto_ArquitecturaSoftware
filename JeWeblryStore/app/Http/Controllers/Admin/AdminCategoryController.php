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

    /**
     * Display the list of categories for administration.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.manage_categories');
        $viewData['categories'] = Category::with('status')->get();

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    /**
     * Display the form for creating a category.
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.create_category');
        $viewData['statuses'] = Status::all();

        return view('admin.categories.create')->with('viewData', $viewData);
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')->with('status', __('admin.category_created'));
    }

    /**
     * Display the form for editing a category.
     */
    public function edit(int $id): View
    {
        $category = Category::findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('admin.edit_category');
        $viewData['category'] = $category;
        $viewData['statuses'] = Status::all();

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    /**
     * Update an existing category.
     */
    public function update(UpdateCategoryRequest $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('status', __('admin.category_updated'));
    }

    /**
     * Delete a category.
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', __('admin.category_deleted'));
    }

    /**
     * Toggle the active status of a category.
     */
    public function toggleStatus(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        return $this->toggleModelStatus($category, 'admin.categories.index');
    }
}
