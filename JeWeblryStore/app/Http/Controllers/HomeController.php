<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
use App\Models\OrderItem;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Home Page - Online Store';
        $viewData['featuredJewels'] = Jewel::with(['status', 'category'])
            ->active()
            ->latest()
            ->take(6)
            ->get();

        return view('home.index')->with('viewData', $viewData);
    }
}
