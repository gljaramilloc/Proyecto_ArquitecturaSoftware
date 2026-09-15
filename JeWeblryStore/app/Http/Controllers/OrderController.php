<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $orders = Order::with(['items.jewel', 'payment', 'status'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        $viewData = [];
        $viewData['title'] = __('order.history_title');
        $viewData['orders'] = $orders;

        return view('orders.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $order = Order::with(['items.jewel', 'payment', 'status'])->findOrFail($id);

        abort_if($order->getUser()->getId() !== Auth::id(), 403);

        $viewData = [];
        $viewData['title'] = __('order.details_title');
        $viewData['order'] = $order;

        return view('orders.show')->with('viewData', $viewData);
    }
}
