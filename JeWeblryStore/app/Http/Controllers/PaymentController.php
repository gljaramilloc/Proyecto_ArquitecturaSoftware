<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function store(StorePaymentRequest $request, int $orderId): RedirectResponse
    {
        $order = Order::findOrFail($orderId);

        abort_if($order->getUser()->getId() !== Auth::id(), 403);
        abort_if($order->getPayment() !== null, 403);

        $pendingStatus = Status::where('name', 'Pendiente')->firstOrFail();

        $payment = new Payment;
        $payment->setAmount($request->validated('amount'));
        $payment->setMethod($request->validated('method'));
        $payment->setDate($request->validated('date'));
        $payment->setStatusId($pendingStatus->getId());
        $payment->setOrderId($order->getId());
        $payment->save();

        return redirect()
            ->route('payments.show', $order->getId())
            ->with('success', __('payment.created'));
    }

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
