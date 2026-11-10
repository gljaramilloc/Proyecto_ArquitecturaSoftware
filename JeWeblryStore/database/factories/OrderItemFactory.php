<?php

namespace Database\Factories;

use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => fn (): int => Order::inRandomOrder()->first()?->getId()
                ?? Order::factory()->create()->getId(),
            'jewel_id' => fn (): int => Jewel::inRandomOrder()->first()?->getId()
                ?? Jewel::factory()->create()->getId(),
            'quantity' => fake()->numberBetween(1, 3),
            'unit_price' => fn (array $attributes): float => Jewel::find($attributes['jewel_id'])?->getPrice()
                ?? fake()->randomFloat(2, 240, 3500),
        ];
    }
}
