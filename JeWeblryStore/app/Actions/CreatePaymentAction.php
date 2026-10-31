<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;

class CreatePaymentAction
{
    /**
     * Create a pending payment for an order.
     */
    public function execute(Order $order, string $method, string $date): Payment
    {
        $pendingStatus = Status::where('name', 'Pending')->firstOrFail();

        $payment = new Payment;
        $payment->setAmount($order->getTotal());
        $payment->setMethod($method);
        $payment->setDate($date);
        $payment->setStatusId($pendingStatus->getId());
        $payment->setOrderId($order->getId());
        $payment->save();

        return $payment;
    }
}
