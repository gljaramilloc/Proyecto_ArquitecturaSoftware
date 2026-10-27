<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the storefront home page with featured jewels.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('home.title');
        $viewData['featuredJewels'] = Jewel::with(['status', 'category'])
            ->active()
            ->latest()
            ->take(6)
            ->get();

        return view('home.index')->with('viewData', $viewData);
    }
}
