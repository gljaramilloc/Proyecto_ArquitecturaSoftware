<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            OrderItem::factory()
                ->count(fake()->numberBetween(1, 4))
                ->create(['order_id' => $order->getId()]);

            $total = OrderItem::where('order_id', $order->getId())
                ->sum(DB::raw('quantity * unit_price'));

            $order->setTotal($total);
            $order->save();
        }
    }
}
