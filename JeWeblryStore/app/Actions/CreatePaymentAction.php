<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;

class CreatePaymentAction
{
    /**
     * Create a payment for an order with the given status (pending by default).
     */
    public function execute(Order $order, string $method, string $date, string $statusName = 'Pending'): Payment
    {
        $paymentStatus = Status::findByName($statusName);

        $payment = new Payment;
        $payment->setAmount($order->getTotal());
        $payment->setMethod($method);
        $payment->setDate($date);
        $payment->setStatusId($paymentStatus->getId());
        $payment->setOrderId($order->getId());
        $payment->save();

        return $payment;
    }
}
