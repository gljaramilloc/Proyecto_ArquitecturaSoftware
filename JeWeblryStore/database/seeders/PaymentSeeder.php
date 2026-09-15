<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Only about 70% of orders get a payment, to simulate pending orders too
        $orders = Order::inRandomOrder()->take((int) (Order::count() * 0.7))->get();

        foreach ($orders as $order) {
            Payment::factory()->create([
                'order_id' => $order->id,
                'amount' => $order->getTotal(),
            ]);
        }
    }
}
