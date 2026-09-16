<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jewel;
use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;

class AdminHomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Dashboard - Online Store';
        $viewData['userCount'] = User::count();
        $viewData['jewelCount'] = Jewel::count();
        $viewData['categoryCount'] = Category::count();
        $viewData['orderCount'] = Order::count();

        return view('admin.index')->with('viewData', $viewData);
    }
}
