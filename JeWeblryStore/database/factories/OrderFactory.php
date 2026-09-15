<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'customer')->inRandomOrder()->first()->id,
            'status_id' => 1,
            'total' => 0,
        ];
    }
}
