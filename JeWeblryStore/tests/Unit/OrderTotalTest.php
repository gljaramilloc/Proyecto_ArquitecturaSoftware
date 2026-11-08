<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class OrderTotalTest extends TestCase
{
    public function test_order_total_is_the_sum_of_its_items_subtotals(): void
    {
        $ring = new OrderItem;
        $ring->setQuantity(2);
        $ring->setUnitPrice(150.50);

        $necklace = new OrderItem;
        $necklace->setQuantity(1);
        $necklace->setUnitPrice(99.00);

        $order = new Order;
        $order->setItems(new Collection([$ring, $necklace]));

        $this->assertEqualsWithDelta(301.00, $ring->getSubtotal(), 0.001);
        $this->assertEqualsWithDelta(400.00, $order->calculateTotal(), 0.001);
    }

    public function test_order_without_items_has_zero_total(): void
    {
        $order = new Order;
        $order->setItems(new Collection);

        $this->assertEqualsWithDelta(0.0, $order->calculateTotal(), 0.001);
    }
}
