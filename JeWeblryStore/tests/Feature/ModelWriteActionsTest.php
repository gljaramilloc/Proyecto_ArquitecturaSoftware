<?php

namespace Tests\Feature;

use App\Actions\CreateCategoryAction;
use App\Actions\CreateJewelAction;
use App\Actions\CreateOrderAction;
use App\Actions\CreatePaymentAction;
use App\Actions\UpdateCategoryAction;
use App\Actions\UpdateJewelAction;
use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelWriteActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_actions_create_and_update_categories_and_jewels(): void
    {
        $status = Status::create(['name' => 'Active']);

        $category = app(CreateCategoryAction::class)->execute([
            'name' => 'Rings',
            'description' => 'Handcrafted rings',
            'slug' => 'rings',
            'status_id' => $status->getId(),
        ]);

        $jewel = app(CreateJewelAction::class)->execute([
            'name' => 'Gold Ring',
            'price' => 25.50,
            'description' => 'A gold ring',
            'status_id' => $status->getId(),
            'stock' => 5,
            'material' => 'Gold',
            'image' => 'ring.jpg',
            'category_id' => $category->getId(),
        ]);

        app(UpdateCategoryAction::class)->execute($category, ['name' => 'Fine Rings']);
        app(UpdateJewelAction::class)->execute($jewel, ['name' => 'Fine Gold Ring']);

        $this->assertSame('Fine Rings', $category->getName());
        $this->assertSame('Fine Gold Ring', $jewel->getName());
        $this->assertDatabaseHas('categories', ['id' => $category->getId(), 'name' => 'Fine Rings']);
        $this->assertDatabaseHas('jewels', ['id' => $jewel->getId(), 'name' => 'Fine Gold Ring']);
    }

    public function test_order_and_payment_actions_create_records_and_decrement_each_jewel_quantity(): void
    {
        $status = Status::create(['name' => 'Pending']);
        $user = User::factory()->create(['status_id' => $status->getId()]);
        $category = Category::create([
            'name' => 'Necklaces',
            'description' => 'Handcrafted necklaces',
            'slug' => 'necklaces',
            'status_id' => $status->getId(),
        ]);
        $firstJewel = Jewel::create([
            'name' => 'Gold Necklace',
            'price' => 10,
            'description' => 'A gold necklace',
            'status_id' => $status->getId(),
            'stock' => 10,
            'material' => 'Gold',
            'image' => 'necklace.jpg',
            'category_id' => $category->getId(),
        ]);
        $secondJewel = Jewel::create([
            'name' => 'Silver Necklace',
            'price' => 20,
            'description' => 'A silver necklace',
            'status_id' => $status->getId(),
            'stock' => 8,
            'material' => 'Silver',
            'image' => 'silver-necklace.jpg',
            'category_id' => $category->getId(),
        ]);

        $order = app(CreateOrderAction::class)->execute($user->getId(), [
            $firstJewel->getId() => 2,
            $secondJewel->getId() => 3,
        ]);
        $payment = app(CreatePaymentAction::class)->execute($order, 'credit_card', '2026-10-31');

        $this->assertSame(80.0, $order->getTotal());
        $this->assertSame(8, $firstJewel->fresh()->getStock());
        $this->assertSame(5, $secondJewel->fresh()->getStock());
        $this->assertSame($order->getId(), $payment->getOrderId());
        $this->assertSame(80.0, $payment->getAmount());
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->getId(),
            'jewel_id' => $firstJewel->getId(),
            'quantity' => 2,
        ]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->getId(),
            'jewel_id' => $secondJewel->getId(),
            'quantity' => 3,
        ]);
    }
}
