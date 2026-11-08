<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\Payment;

/**
 * Abstraction used by the controllers to pay an order without depending
 * on a concrete payment method (Dependency Inversion Principle).
 * The concrete class is resolved in AppServiceProvider.
 */
interface PaymentProcessor
{
    public function pay(Order $order): Payment;
}
