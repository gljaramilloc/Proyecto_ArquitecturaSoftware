<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => fn (): int => Order::inRandomOrder()->first()?->getId()
                ?? Order::factory()->create()->getId(),
            'amount' => fn (array $attributes): float => isset($attributes['order_id'])
                ? (Order::find($attributes['order_id'])?->getTotal() ?? 0.00)
                : fake()->randomFloat(2, 240, 4500),
            'method' => fake()->randomElement([
                Payment::METHOD_BALANCE,
                'credit_card',
                'debit_card',
                'paypal',
            ]),
            'date' => fake()->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'status_id' => fn (): int => Status::where('name', 'Approved')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Approved'])->getId(),
        ];
    }
}
