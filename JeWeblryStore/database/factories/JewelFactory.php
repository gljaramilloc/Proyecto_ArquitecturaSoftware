<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class JewelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'price' => fake()->randomFloat(2, 20, 2000),
            'description' => fake()->sentence(),
            'status_id' => 1,
            'stock' => fake()->numberBetween(0, 50),
            'material' => fake()->randomElement(['Gold', 'Silver', 'Platinum', 'Rose Gold']),
            'image' => 'placeholder.jpg',
            'category_id' => Category::inRandomOrder()->first()->getId(),
        ];
    }
}
