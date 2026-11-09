<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\Models\Jewel;
use App\Services\ExchangeRateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Inject the order creation action and exchange rate service.
     */
    public function __construct(
        private readonly CreateOrderAction $createOrderAction,
        private readonly ExchangeRateService $exchangeRateService,
    ) {}

    /**
     * Display the current cart and its total in USD and estimated COP.
     */
    public function index(): View
    {
        $total = 0;
        $jewelsInCart = [];

        $cartSession = session()->get('cart', []);

        if (! empty($cartSession)) {
            $jewelsInCart = Jewel::with('category')->findMany(array_keys($cartSession));

            foreach ($jewelsInCart as $jewel) {
                $quantity = $cartSession[$jewel->getId()];
                $total += $jewel->getPrice() * $quantity;
            }
        }

        $viewData = [];
        $viewData['title'] = __('cart.title');
        $viewData['subtitle'] = __('cart.your_cart');
        $viewData['total'] = $total;
        $viewData['jewels'] = $jewelsInCart;
        $viewData['cartSession'] = $cartSession;
        $viewData['exchangeQuote'] = $this->exchangeRateService->getUsdToCopQuote();

        return view('cart.index')->with('viewData', $viewData);
    }

    /**
     * Add one jewel to the cart.
     */
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

    /**
     * Create an order with one jewel and redirect to payment.
     */
    public function buyNow(int $id): RedirectResponse
    {
        $jewel = Jewel::findOrFail($id);

        if ($jewel->getStock() < 1) {
            return back()->with('error', __('cart.out_of_stock'));
        }

        $order = $this->createOrderAction->execute(Auth::user()->getId(), [$jewel->getId() => 1]);

        return redirect()->route('payments.create', $order->getId());
    }

    /**
     * Remove all items from the cart.
     */
    public function removeAll(): RedirectResponse
    {
        session()->forget('cart');

        return back();
    }

    /**
     * Create an order from the current cart and redirect to payment.
     */
    public function purchase(): RedirectResponse
    {
        $cartSession = session()->get('cart', []);

        if (empty($cartSession)) {
            return redirect()->route('cart.index');
        }

        $order = $this->createOrderAction->execute(Auth::user()->getId(), $cartSession);

        session()->forget('cart');

        return redirect()->route('payments.create', $order->getId());
    }
}
