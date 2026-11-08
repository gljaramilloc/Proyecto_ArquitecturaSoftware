<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jewel;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * List the active categories for the storefront.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('catalog.categories_title');
        $viewData['categories'] = Category::with('status')->active()->orderBy('name')->get();

        return view('categories.index')->with('viewData', $viewData);
    }

    /**
     * Show an active category and its active jewels.
     */
    public function show(int $id): View
    {
        $category = Category::with('status')->active()->findOrFail($id);

        $viewData = [];
        $viewData['title'] = $category->getName();
        $viewData['category'] = $category;
        $viewData['jewels'] = Jewel::with(['status', 'category'])
            ->active()
            ->search(null, $category->getId())
            ->paginate(9);

        return view('categories.show')->with('viewData', $viewData);
    }
}
