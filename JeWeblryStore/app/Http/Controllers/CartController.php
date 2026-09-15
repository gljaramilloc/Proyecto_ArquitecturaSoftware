<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartSession = session()->get('cart', []);

        $details = Order::calculateCartDetails($cartSession);

        $viewData = [];
        $viewData['title'] = __('cart.title').' - Online Store';
        $viewData['subtitle'] = __('cart.your_cart');
        $viewData['total'] = $details['total'];
        $viewData['jewels'] = $details['jewels'];
        $viewData['cartSession'] = $cartSession;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(string $id): RedirectResponse
    {
        $cartSession = session()->get('cart', []);

        try {
            $cartSession = Order::addJewelToCartSession($cartSession, $id);
            session()->put('cart', $cartSession);

            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function removeAll(): RedirectResponse
    {
        session()->forget('cart');

        return back();
    }

    public function purchase(): View|RedirectResponse
    {
        $cartSession = session()->get('cart', []);
        $userId = Auth::user()->getId();

        try {
            $order = Order::processPurchase($cartSession, $userId);

            // Wipe the cart out of the session
            session()->forget('cart');

            $viewData = [];
            $viewData['title'] = __('cart.purchase_title').' - Online Store';
            $viewData['subtitle'] = __('cart.purchase_status');
            $viewData['order'] = $order;

            return view('cart.purchase')->with('viewData', $viewData);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->withErrors(['message' => $e->getMessage()]);
        }
    }
}
