<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Seed approved payments for roughly seventy percent of orders while leaving pending ones testable.
     */
    public function run(): void
    {
        $approvedStatus = Status::where('name', 'Approved')->first() ?? Status::firstOrCreate(['name' => 'Approved']);
        $demoCustomer = User::where('email', 'customer@jeweblrystore.com')->first();

        if ($demoCustomer !== null) {
            $demoPaidCount = Order::where('user_id', $demoCustomer->getId())
                ->whereHas('payment')
                ->count();

            if ($demoPaidCount < 2) {
                $demoOrders = Order::where('user_id', $demoCustomer->getId())
                    ->whereDoesntHave('payment')
                    ->orderBy('created_at')
                    ->take(2 - $demoPaidCount)
                    ->get();

                foreach ($demoOrders as $demoOrder) {
                    $this->approveOrderWithPayment($demoOrder, $approvedStatus->getId(), Payment::METHOD_BALANCE);
                }
            }
        }

        $targetPaidCount = (int) floor(Order::query()->count() * 0.7);
        $alreadyPaidCount = Payment::query()->count();
        $remainingToPay = max(0, $targetPaidCount - $alreadyPaidCount);

        if ($remainingToPay === 0) {
            return;
        }

        $unpaidOrdersQuery = Order::whereDoesntHave('payment');

        if ($demoCustomer !== null) {
            $unpaidOrdersQuery->where('user_id', '!=', $demoCustomer->getId());
        }

        $ordersToPay = $unpaidOrdersQuery->inRandomOrder()->take($remainingToPay)->get();

        foreach ($ordersToPay as $order) {
            $this->approveOrderWithPayment($order, $approvedStatus->getId());
        }
    }

    /**
     * Create an approved payment record for an order and synchronize the order status.
     */
    private function approveOrderWithPayment(Order $order, int $approvedStatusId, ?string $method = null): void
    {
        $attributes = [
            'order_id' => $order->getId(),
            'amount' => $order->getTotal(),
            'status_id' => $approvedStatusId,
        ];

        if ($method !== null) {
            $attributes['method'] = $method;
        }

        Payment::factory()->create($attributes);

        $order->setStatusId($approvedStatusId);
        $order->save();
    }
}
