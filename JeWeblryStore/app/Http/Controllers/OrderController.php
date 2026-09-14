<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('order.title').' - Online Store';
        $viewData['subtitle'] = __('order.my_orders');

        $userId = Auth::user()->getId();
        $viewData['orders'] = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $userId = Auth::user()->getId();

        // Eager load items and jewels
        $order = Order::with('items.jewel')->where('user_id', $userId)->findOrFail($id);

        $viewData = [];
        $viewData['title'] = __('order.order_details').' - Online Store';
        $viewData['subtitle'] = __('order.order_id').': '.$order->getId();
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }
}
