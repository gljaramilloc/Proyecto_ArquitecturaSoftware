<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $orderDate = fake()->dateTimeBetween('-75 days', 'now');

        return [
            'user_id' => fn (): int => User::where('role', 'customer')->inRandomOrder()->first()?->getId()
                ?? User::factory()->create()->getId(),
            'status_id' => fn (): int => Status::where('name', 'Pending')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Pending'])->getId(),
            'total' => 0.00,
            'created_at' => $orderDate,
            'updated_at' => $orderDate,
        ];
    }
}
