<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jewel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JewelController extends Controller
{
    /**
     * Public jewel catalog. Supports search by name and/or category
     * through the "name" and "category_id" query parameters.
     */
    public function index(Request $request): View
    {
        $searchName = $request->query('name');
        $searchCategoryId = $request->filled('category_id') ? (int) $request->query('category_id') : null;

        $viewData = [];
        $viewData['title'] = 'Catalog';
        $viewData['jewels'] = Jewel::with(['status', 'category'])
            ->search($searchName, $searchCategoryId)
            ->get();
        $viewData['categories'] = Category::all();
        $viewData['searchName'] = $searchName;
        $viewData['searchCategoryId'] = $searchCategoryId;

        return view('jewels.index')->with('viewData', $viewData);
    }

    /**
     * Show a single jewel's detail page.
     */
    public function show(Jewel $jewel): View
    {
        $jewel->load(['status', 'category']);

        $viewData = [];
        $viewData['title'] = $jewel->getName();
        $viewData['jewel'] = $jewel;

        return view('jewels.show')->with('viewData', $viewData);
    }
}
