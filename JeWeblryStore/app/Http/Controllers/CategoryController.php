<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * List categories for the storefront.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('catalog.categories_title');
        $viewData['categories'] = Category::with('status')->get();

        return view('categories.index')->with('viewData', $viewData);
    }

    /**
     * Show a category and its associated jewels.
     */
    public function show(int $id): View
    {
        $category = Category::with(['status', 'jewels.status'])->findOrFail($id);

        $viewData = [];
        $viewData['title'] = $category->getName();
        $viewData['category'] = $category;
        $viewData['jewels'] = $category->getJewels();

        return view('categories.show')->with('viewData', $viewData);
    }
}
