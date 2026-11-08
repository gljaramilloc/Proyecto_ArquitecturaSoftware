<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Jewel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JewelController extends Controller
{
    /**
     * Display the public catalog of active jewels with optional name or category filtering.
     */
    public function index(Request $request): View
    {
        $searchName = $request->query('name');
        $searchCategoryId = $request->filled('category_id') ? (int) $request->query('category_id') : null;

        $viewData = [];
        $viewData['title'] = __('catalog.title');
        $viewData['jewels'] = Jewel::with(['status', 'category'])
            ->active()
            ->search($searchName, $searchCategoryId)
            ->paginate(9)
            ->withQueryString();
        $viewData['categories'] = Category::active()->orderBy('name')->get();
        $viewData['searchName'] = $searchName;
        $viewData['searchCategoryId'] = $searchCategoryId;
        $viewData['isFiltered'] = $searchName !== null || $searchCategoryId !== null;

        return view('jewels.index')->with('viewData', $viewData);
    }

    /**
     * Display the details page for an active jewel.
     */
    public function show(int $id): View
    {
        $jewel = Jewel::with(['status', 'category'])->active()->findOrFail($id);

        $viewData = [];
        $viewData['title'] = $jewel->getName();
        $viewData['jewel'] = $jewel;

        return view('jewels.show')->with('viewData', $viewData);
    }
}
