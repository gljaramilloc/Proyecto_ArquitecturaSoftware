<?php

namespace Database\Seeders;

use App\Models\Jewel;
use Illuminate\Database\Seeder;

class JewelSeeder extends Seeder
{
    public function run(): void
    {
        Jewel::factory()->count(20)->create();
    }
}
