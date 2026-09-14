<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $jewelsInCart = [];

        $cartSession = $request->session()->get('cart', []);

        if (!empty($cartSession)) {
            // Get jewels whose IDs match the keys (jewel IDs) in the session
            $jewelsInCart = Jewel::findMany(array_keys($cartSession));

            foreach ($jewelsInCart as $jewel) {
                // Determine total by multiplying jewel price by quantity requested
                $quantity = $cartSession[$jewel->getId()];
                $total += $jewel->getPrice() * $quantity;
            }
        }

        $viewData = [];
        $viewData['title'] = __('cart.title') . ' - Online Store';
        $viewData['subtitle'] = __('cart.your_cart');
        $viewData['total'] = $total;
        $viewData['jewels'] = $jewelsInCart;
        $viewData['cartSession'] = $cartSession;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(string $id, Request $request): RedirectResponse
    {
        $cartSession = $request->session()->get('cart', []);

        // If jewel is already in the cart, increase quantity; otherwise, set to 1
        if (array_key_exists($id, $cartSession)) {
            $cartSession[$id] = $cartSession[$id] + 1;
        } else {
            $cartSession[$id] = 1;
        }

        $request->session()->put('cart', $cartSession);

        return back();
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back();
    }

    public function purchase(Request $request)
    {
        $cartSession = $request->session()->get('cart', []);

        if (empty($cartSession)) {
            return redirect()->route('cart.index');
        }

        $userId = Auth::user()->getId();
        $jewelsInSession = Jewel::findMany(array_keys($cartSession));

        $total = 0;
        foreach ($jewelsInSession as $jewel) {
            $total += $jewel->getPrice() * $cartSession[$jewel->getId()];
        }

        // Create the Order header
        $order = new Order();
        $order->setUserId($userId);
        $order->setTotal($total);
        // We set statusId to 1 by default (Pending/Processing depending on StatusSeeder)
        $order->setStatusId(1);
        $order->save();

        // Save each item logically linked to the order
        foreach ($jewelsInSession as $jewel) {
            $quantity = $cartSession[$jewel->getId()];
            $orderItem = new OrderItem();
            $orderItem->setQuantity($quantity);
            $orderItem->setUnitPrice($jewel->getPrice());
            $orderItem->setJewelId($jewel->getId());
            $orderItem->setOrderId($order->getId());
            $orderItem->save();
        }

        // Wipe the cart out of the session
        $request->session()->forget('cart');

        $viewData = [];
        $viewData['title'] = __('cart.purchase_title') . ' - Online Store';
        $viewData['subtitle'] = __('cart.purchase_status');
        $viewData['order'] = $order;

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
