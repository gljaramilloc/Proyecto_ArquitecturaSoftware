<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => fn (): int => Order::inRandomOrder()->first()?->getId()
                ?? Order::factory()->create()->getId(),
            'amount' => fn (array $attributes): float => isset($attributes['order_id'])
                ? (Order::find($attributes['order_id'])?->getTotal() ?? 0.00)
                : fake()->randomFloat(2, 240, 4500),
            'method' => fake()->randomElement([
                Payment::METHOD_BALANCE,
                Payment::METHOD_CHEQUE,
            ]),
            'date' => function (array $attributes): string {
                $orderCreatedAt = isset($attributes['order_id'])
                    ? Order::find($attributes['order_id'])?->getCreatedAt()
                    : null;

                if ($orderCreatedAt !== null) {
                    $startDate = Carbon::parse($orderCreatedAt);
                    $endDate = $startDate->copy()->addDays(3);
                    if ($endDate->isFuture()) {
                        $endDate = now();
                    }

                    return $startDate->lte($endDate)
                        ? Carbon::instance(fake()->dateTimeBetween($startDate, $endDate))->format('Y-m-d')
                        : $startDate->format('Y-m-d');
                }

                return fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d');
            },
            'status_id' => function (array $attributes): int {
                $statusName = ($attributes['method'] ?? Payment::METHOD_BALANCE) === Payment::METHOD_CHEQUE
                    ? 'Pending'
                    : 'Approved';

                return Status::where('name', $statusName)->first()?->getId()
                    ?? Status::firstOrCreate(['name' => $statusName])->getId();
            },
        ];
    }

    /**
     * Indicate that the payment was settled with account balance.
     */
    public function balance(): static
    {
        return $this->state(fn (): array => [
            'method' => Payment::METHOD_BALANCE,
            'status_id' => Status::where('name', 'Approved')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Approved'])->getId(),
        ]);
    }

    /**
     * Indicate that the payment was registered via PDF cheque and remains pending.
     */
    public function cheque(): static
    {
        return $this->state(fn (): array => [
            'method' => Payment::METHOD_CHEQUE,
            'status_id' => Status::where('name', 'Pending')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Pending'])->getId(),
        ]);
    }
}
