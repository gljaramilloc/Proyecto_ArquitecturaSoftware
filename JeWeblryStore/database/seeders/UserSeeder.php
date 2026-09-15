<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'lastNames' => 'Test',
            'email' => 'admin@jeweblrystore.com',
            'role' => 'admin',
        ]);
    }
}
