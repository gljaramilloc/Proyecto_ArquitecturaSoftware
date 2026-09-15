<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Home Page - Online Store';
        $topOrderItems = OrderItem::getTopSold(3);

        $viewData['topJewels'] = $topOrderItems;

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = 'About us - Online Store';
        $viewData['subtitle'] = 'About us';
        $viewData['description'] = 'This is an about page ...';
        $viewData['author'] = 'Developed by: Gisel Jaramillo\'s team';

        return view('home.about')->with('viewData', $viewData);
    }

    public function contact(): View
    {
        $viewData = [];
        $viewData['title'] = 'Contact - Online Store';
        $viewData['subtitle'] = 'Contact';
        $viewData['email'] = 'contact@jewelstore.com';
        $viewData['address'] = '355 Medellín, Colombia';
        $viewData['phone'] = '+57 123 456 789';

        return view('home.contact')->with('viewData', $viewData);
    }
}
