<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            OrderItem::factory()
                ->count(fake()->numberBetween(1, 4))
                ->create(['order_id' => $order->id]);

            $total = OrderItem::where('order_id', $order->id)
                ->get()
                ->sum(fn ($item) => $item->quantity * $item->unitPrice);

            $order->setTotal($total);
            $order->save();
        }
    }
}
