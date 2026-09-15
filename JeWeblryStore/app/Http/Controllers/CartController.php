<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $total = 0;
        $jewelsInCart = [];

        $cartSession = session()->get('cart', []);

        if (! empty($cartSession)) {
            // Get jewels whose IDs match the keys (jewel IDs) in the session
            $jewelsInCart = Jewel::findMany(array_keys($cartSession));

            foreach ($jewelsInCart as $jewel) {
                // Determine total by multiplying jewel price by quantity requested
                $quantity = $cartSession[$jewel->getId()];
                $total += $jewel->getPrice() * $quantity;
            }
        }

        $viewData = [];
        $viewData['title'] = __('cart.title').' - Online Store';
        $viewData['subtitle'] = __('cart.your_cart');
        $viewData['total'] = $total;
        $viewData['jewels'] = $jewelsInCart;
        $viewData['cartSession'] = $cartSession;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(string $id): RedirectResponse
    {
        $cartSession = session()->get('cart', []);

        // If jewel is already in the cart, increase quantity; otherwise, set to 1
        if (array_key_exists($id, $cartSession)) {
            $cartSession[$id] = $cartSession[$id] + 1;
        } else {
            $cartSession[$id] = 1;
        }

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
        $jewelsInSession = Jewel::findMany(array_keys($cartSession));

        $total = 0;
        foreach ($jewelsInSession as $jewel) {
            $total += $jewel->getPrice() * $cartSession[$jewel->getId()];
        }

        // Database transaction ensures Atomicity. Either everything is saved, or nothing is.
        $order = DB::transaction(function () use ($userId, $total, $jewelsInSession, $cartSession) {
            // Create the Order header
            $order = new Order;
            $order->setUserId($userId);
            $order->setTotal($total);
            // We set statusId to 1 by default (Pending/Processing depending on StatusSeeder)
            $order->setStatusId(1);
            $order->save();

            // Save each item logically linked to the order
            foreach ($jewelsInSession as $jewel) {
                $quantity = $cartSession[$jewel->getId()];
                $orderItem = new OrderItem;
                $orderItem->setQuantity($quantity);
                $orderItem->setUnitPrice($jewel->getPrice());
                $orderItem->setJewelId($jewel->getId());
                $orderItem->setOrderId($order->getId());
                $orderItem->save();
            }

            return $order;
        });

        // Wipe the cart out of the session
        session()->forget('cart');

        $viewData = [];
        $viewData['title'] = __('cart.purchase_title').' - Online Store';
        $viewData['subtitle'] = __('cart.purchase_status');
        $viewData['order'] = $order;

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
