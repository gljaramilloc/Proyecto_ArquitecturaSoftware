<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with initial and demonstration data.
     */
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            CategorySeeder::class,
            DefaultJewelSeeder::class,
            JewelSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
