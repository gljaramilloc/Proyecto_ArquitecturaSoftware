<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed sample customer orders spread across recent dates.
     */
    public function run(): void
    {
        if (Order::query()->count() >= 20) {
            return;
        }

        $pendingStatus = Status::where('name', 'Pending')->first() ?? Status::firstOrCreate(['name' => 'Pending']);
        $demoCustomer = User::where('email', 'customer@jeweblrystore.com')->first();

        if ($demoCustomer !== null && Order::where('user_id', $demoCustomer->getId())->count() === 0) {
            foreach ([28, 16, 7, 2] as $daysAgo) {
                $orderDate = now()->subDays($daysAgo);
                Order::factory()->create([
                    'user_id' => $demoCustomer->getId(),
                    'status_id' => $pendingStatus->getId(),
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);
            }
        }

        $remainingOrders = max(0, 20 - Order::query()->count());
        if ($remainingOrders === 0) {
            return;
        }

        $otherCustomerIds = User::where('role', 'customer')
            ->when($demoCustomer !== null, fn ($query) => $query->where('id', '!=', $demoCustomer->getId()))
            ->pluck('id')
            ->all();

        for ($i = 0; $i < $remainingOrders; $i++) {
            $attributes = ['status_id' => $pendingStatus->getId()];

            if ($otherCustomerIds !== []) {
                $attributes['user_id'] = fake()->randomElement($otherCustomerIds);
            }

            Order::factory()->create($attributes);
        }
    }
}
