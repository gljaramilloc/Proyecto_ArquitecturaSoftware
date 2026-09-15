<?php

namespace App\Http\Controllers;

use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $total = 0;
        $jewelsInCart = [];

        $cartSession = session()->get('cart', []);

        if (! empty($cartSession)) {
            // Get jewels whose IDs match the keys (jewel IDs) in the session
            $jewelsInCart = Jewel::with('category')->findMany(array_keys($cartSession));

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

    public function add(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);

        if ($jewel->getStock() < 1) {
            return back()->with('error', __('cart.out_of_stock'));
        }

        $cartSession = session()->get('cart', []);
        $quantity = (int) ($cartSession[$id] ?? 0);

        if ($quantity >= $jewel->getStock()) {
            return back()->with('error', __('cart.stock_limit'));
        }

        $cartSession[$id] = $quantity + 1;
        session()->put('cart', $cartSession);

        return back()->with('success', __('cart.added'));
    }

    public function buyNow(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);

        if ($jewel->getStock() < 1) {
            return back()->with('error', __('cart.out_of_stock'));
        }

        $order = $this->createOrder([$jewel->getId() => 1]);

        return redirect()->route('payments.create', $order->getId());
    }

    public function removeAll(): RedirectResponse
    {
        session()->forget('cart');

        return back();
    }

    public function purchase(): RedirectResponse
    {
        $cartSession = session()->get('cart', []);

        if (empty($cartSession)) {
            return redirect()->route('cart.index');
        }

        $order = $this->createOrder($cartSession);

        session()->forget('cart');

        return redirect()->route('payments.create', $order->getId());
    }

    private function createOrder(array $cartSession): Order
    {
        $userId = Auth::user()->getId();
        $jewels = Jewel::findMany(array_keys($cartSession));

        abort_if($jewels->count() !== count($cartSession), 422, __('cart.invalid_items'));

        return DB::transaction(function () use ($userId, $cartSession, $jewels): Order {
            $total = 0;
            foreach ($jewels as $jewel) {
                $quantity = (int) ($cartSession[$jewel->getId()] ?? 0);
                abort_if($quantity < 1 || $quantity > $jewel->getStock(), 422, __('cart.stock_limit'));
                $total += $jewel->getPrice() * $quantity;
            }

            $pendingStatus = Status::where('name', 'Pending')->firstOrFail();

            $order = new Order;
            $order->setUserId($userId);
            $order->setTotal($total);
            $order->setStatusId($pendingStatus->getId());
            $order->save();

            foreach ($jewels as $jewel) {
                $orderItem = new OrderItem;
                $orderItem->setQuantity((int) $cartSession[$jewel->getId()]);
                $orderItem->setUnitPrice($jewel->getPrice());
                $orderItem->setJewelId($jewel->getId());
                $orderItem->setOrderId($order->getId());
                $orderItem->save();
            }

            return $order;
        });
    }
}
