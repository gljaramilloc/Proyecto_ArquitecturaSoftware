<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
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
        $jewel = Jewel::find($id);

        if (! $jewel) {
            return back()->withErrors(['message' => 'The selected jewel does not exist.']);
        }

        $cartSession = session()->get('cart', []);

        $currentQuantity = array_key_exists($id, $cartSession) ? $cartSession[$id] : 0;
        $requestedQuantity = $currentQuantity + 1;

        if ($requestedQuantity > $jewel->getStock()) {
            return back()->withErrors(['message' => 'Not enough stock available for this jewel.']);
        }

        $cartSession[$id] = $requestedQuantity;

        session()->put('cart', $cartSession);

        return back();
    }

    public function removeAll(): RedirectResponse
    {
        session()->forget('cart');

        return back();
    }

    public function purchase(): View|RedirectResponse
    {
        $cartSession = session()->get('cart', []);

        if (empty($cartSession)) {
            return redirect()->route('cart.index');
        }

        $userId = Auth::user()->getId();

        $order = Order::processPurchase($cartSession, $userId);

        // Wipe the cart out of the session
        session()->forget('cart');

        $viewData = [];
        $viewData['title'] = __('cart.purchase_title').' - Online Store';
        $viewData['subtitle'] = __('cart.purchase_status');
        $viewData['order'] = $order;

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
