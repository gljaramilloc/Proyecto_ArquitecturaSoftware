<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@jeweblrystore.com'],
            User::factory()->raw([
                'name' => 'Admin',
                'lastNames' => 'Test',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ])
        );
    }
}
