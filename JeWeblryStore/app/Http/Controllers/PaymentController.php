<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientBalanceException;
use App\Http\Requests\StorePaymentRequest;
use App\Interfaces\PaymentProcessor;
use App\Models\Order;
use App\Services\ExchangeRateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentController extends Controller
{
    /**
     * Inject the exchange rate service for checkout currency reference.
     */
    public function __construct(private readonly ExchangeRateService $exchangeRateService) {}

    /**
     * Display the payment form for an order owned by the authenticated user.
     */
    public function create(int $orderId): View
    {
        $order = $this->findCustomerOrder($orderId);

        abort_if($order->getPayment() !== null, 403);

        $viewData = [];
        $viewData['title'] = __('payment.title');
        $viewData['order'] = $order;
        $viewData['balance'] = Auth::user()->getBalance();
        $viewData['exchangeQuote'] = $this->exchangeRateService->getUsdToCopQuote();

        return view('payments.create')->with('viewData', $viewData);
    }

    /**
     * Pay the order with the processor that matches the selected method.
     */
    public function store(StorePaymentRequest $request, int $orderId): RedirectResponse
    {
        $order = $this->findCustomerOrder($orderId);

        abort_if($order->getPayment() !== null, 403);

        // The concrete processor (cheque or balance) is resolved by AppServiceProvider
        $paymentProcessor = app()->makeWith(PaymentProcessor::class, ['method' => $request->validated('method')]);

        try {
            $paymentProcessor->pay($order);
        } catch (InsufficientBalanceException) {
            return back()->withInput()->with('error', __('payment.insufficient_balance'));
        }

        return redirect()
            ->route('payments.show', $order->getId())
            ->with('success', __('payment.created'));
    }

    /**
     * Display payment details for an order owned by the authenticated user.
     */
    public function show(int $orderId): View
    {
        $order = $this->findCustomerOrder($orderId);

        $viewData = [];
        $viewData['title'] = __('payment.details_title');
        $viewData['order'] = $order;
        $viewData['payment'] = $order->getPayment();

        return view('payments.show')->with('viewData', $viewData);
    }

    /**
     * Download the PDF cheque generated for the order payment.
     */
    public function downloadCheque(int $orderId): StreamedResponse
    {
        $order = $this->findCustomerOrder($orderId);
        $payment = $order->getPayment();

        abort_if($payment === null || ! $payment->isCheque(), 404);
        abort_unless(Storage::disk('local')->exists($payment->getChequePath()), 404);

        return Storage::disk('local')->download($payment->getChequePath(), 'cheque-order-'.$order->getId().'.pdf');
    }

    /**
     * Find the order and make sure it belongs to the authenticated customer.
     */
    private function findCustomerOrder(int $orderId): Order
    {
        $order = Order::with(['user', 'payment.status'])->findOrFail($orderId);

        abort_if($order->getUserId() !== Auth::id(), 403);

        return $order;
    }
}
