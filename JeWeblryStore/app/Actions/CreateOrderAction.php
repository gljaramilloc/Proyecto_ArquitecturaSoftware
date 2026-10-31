<?php

namespace App\Actions;

use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    /**
     * Create an order and its items while locking the selected jewels.
     *
     * @param  array<int, int|string>  $cartSession
     */
    public function execute(int $userId, array $cartSession): Order
    {
        return DB::transaction(function () use ($userId, $cartSession): Order {
            $jewels = Jewel::whereIn('id', array_keys($cartSession))
                ->lockForUpdate()
                ->get();

            abort_if($jewels->count() !== count($cartSession), 422, __('cart.invalid_items'));

            $total = 0;
            $quantities = [];

            foreach ($jewels as $jewel) {
                $quantity = (int) ($cartSession[$jewel->getId()] ?? 0);
                abort_if($quantity < 1 || $quantity > $jewel->getStock(), 422, __('cart.stock_limit'));

                $quantities[$jewel->getId()] = $quantity;
                $total += $jewel->getPrice() * $quantity;
            }

            $pendingStatus = Status::where('name', 'Pending')->firstOrFail();

            $order = new Order;
            $order->setUserId($userId);
            $order->setTotal($total);
            $order->setStatusId($pendingStatus->getId());
            $order->save();

            foreach ($jewels as $jewel) {
                $quantity = $quantities[$jewel->getId()];

                $orderItem = new OrderItem;
                $orderItem->setQuantity($quantity);
                $orderItem->setUnitPrice($jewel->getPrice());
                $orderItem->setJewelId($jewel->getId());
                $orderItem->setOrderId($order->getId());
                $orderItem->save();

                $jewel->setStock($jewel->getStock() - $quantity);
                $jewel->save();
            }

            return $order;
        });
    }
}
