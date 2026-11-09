<?php

namespace Database\Seeders;

use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Populate each seeded order with distinct jewels and recalculate its total.
     */
    public function run(): void
    {
        $availableJewels = Jewel::active()->where('stock', '>', 0)->get();

        if ($availableJewels->isEmpty()) {
            return;
        }

        $orders = Order::with('items')->get();

        foreach ($orders as $order) {
            if ($order->getItems()->isNotEmpty()) {
                continue;
            }

            $itemCount = min($availableJewels->count(), fake()->numberBetween(1, 3));
            $selectedJewels = $availableJewels->random($itemCount);

            foreach ($selectedJewels as $jewel) {
                OrderItem::factory()->create([
                    'order_id' => $order->getId(),
                    'jewel_id' => $jewel->getId(),
                    'quantity' => fake()->numberBetween(1, 2),
                    'unit_price' => $jewel->getPrice(),
                ]);
            }

            $refreshedOrder = Order::with('items')->findOrFail($order->getId());
            $refreshedOrder->setTotal(round($refreshedOrder->calculateTotal(), 2));
            $refreshedOrder->save();
        }
    }
}
