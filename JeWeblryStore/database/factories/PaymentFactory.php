<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => 0,
            'method' => fake()->randomElement(['credit_card', 'debit_card', 'paypal']),
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'status_id' => 1,
            'order_id' => null,
        ];
    }
}
