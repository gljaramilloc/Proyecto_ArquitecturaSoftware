<?php

namespace App\Http\Controllers;

use App\Actions\CreatePaymentAction;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(private readonly CreatePaymentAction $createPaymentAction)
    {
    }

    /**
     * Display the payment form for an order owned by the authenticated user.
     */
    public function create(int $orderId): View
    {
        $order = Order::findOrFail($orderId);

        abort_if($order->getUser()->getId() !== Auth::id(), 403);
        abort_if($order->getPayment() !== null, 403);

        $viewData = [];
        $viewData['title'] = __('payment.title');
        $viewData['order'] = $order;

        return view('payments.create')->with('viewData', $viewData);
    }

    /**
     * Store a payment for an order owned by the authenticated user.
     */
    public function store(StorePaymentRequest $request, int $orderId): RedirectResponse
    {
        $order = Order::findOrFail($orderId);

        abort_if($order->getUser()->getId() !== Auth::id(), 403);
        abort_if($order->getPayment() !== null, 403);

        $this->createPaymentAction->execute(
            $order,
            $request->validated('method'),
            $request->validated('date'),
        );

        return redirect()
            ->route('payments.show', $order->getId())
            ->with('success', __('payment.created'));
    }

    /**
     * Display payment details for an order owned by the authenticated user.
     */
    public function show(int $orderId): View
    {
        $order = Order::findOrFail($orderId);

        abort_if($order->getUser()->getId() !== Auth::id(), 403);

        $viewData = [];
        $viewData['title'] = __('payment.details_title');
        $viewData['order'] = $order;
        $viewData['payment'] = $order->getPayment();

        return view('payments.show')->with('viewData', $viewData);
    }
}
