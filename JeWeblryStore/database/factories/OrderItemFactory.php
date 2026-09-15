<?php

namespace Database\Factories;

use App\Models\Jewel;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        $jewel = Jewel::inRandomOrder()->first();

        return [
            'order_id' => Order::inRandomOrder()->first()->getId(),
            'jewel_id' => $jewel->getId(),
            'quantity' => fake()->numberBetween(1, 5),
            'unit_price' => $jewel->getPrice(),
        ];
    }
}
