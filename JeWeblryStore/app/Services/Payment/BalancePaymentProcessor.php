<?php

namespace App\Services\Payment;

use App\Actions\CreatePaymentAction;
use App\Exceptions\InsufficientBalanceException;
use App\Interfaces\PaymentProcessor;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Pays an order by discounting its total from the customer's balance.
 * The payment and the order are approved immediately.
 */
class BalancePaymentProcessor implements PaymentProcessor
{
    public function __construct(private readonly CreatePaymentAction $createPaymentAction) {}

    public function pay(Order $order): Payment
    {
        return DB::transaction(function () use ($order): Payment {
            $customer = User::lockForUpdate()->findOrFail($order->getUserId());

            if (! $customer->hasEnoughBalance($order->getTotal())) {
                throw new InsufficientBalanceException;
            }

            $customer->setBalance(round($customer->getBalance() - $order->getTotal(), 2));
            $customer->save();

            $payment = $this->createPaymentAction->execute($order, Payment::METHOD_BALANCE, now()->toDateString(), 'Approved');

            $order->setStatusId($payment->getStatusId());
            $order->save();

            return $payment;
        });
    }
}
