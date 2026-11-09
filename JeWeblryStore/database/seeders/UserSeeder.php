<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed administrator, demo customer, and sample customer accounts for pagination.
     */
    public function run(): void
    {
        $activeStatus = Status::where('name', 'Active')->first() ?? Status::firstOrCreate(['name' => 'Active']);

        User::updateOrCreate(
            ['email' => 'admin@jeweblrystore.com'],
            [
                'name' => 'Admin',
                'lastNames' => 'Atelier Director',
                'phoneNumber' => '+57 300 410 5248',
                'address' => 'Carrera 35 #8A-19, El Poblado, Medellin',
                'role' => 'admin',
                'balance' => 25000.00,
                'status_id' => $activeStatus->getId(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@jeweblrystore.com'],
            [
                'name' => 'Valentina',
                'lastNames' => 'Montoya Restrepo',
                'phoneNumber' => '+57 310 684 2190',
                'address' => 'Transversal Superior #12-45, El Poblado, Medellin',
                'role' => 'customer',
                'balance' => 18500.00,
                'status_id' => $activeStatus->getId(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );

        $targetCustomerCount = 15;
        $existingCustomers = User::where('role', 'customer')->count();

        if ($existingCustomers < $targetCustomerCount) {
            User::factory()
                ->count($targetCustomerCount - $existingCustomers)
                ->create(['status_id' => $activeStatus->getId()]);
        }
    }
}
