<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Models\User;
use Database\Factories\JewelFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    /**
     * Seed standalone showcase jewels and ranked order items to test top-selling queries.
     */
    public function run(): void
    {
        $activeStatus = Status::where('name', 'Active')->first() ?? Status::firstOrCreate(['name' => 'Active']);
        $approvedStatus = Status::where('name', 'Approved')->first() ?? Status::firstOrCreate(['name' => 'Approved']);

        $user = User::firstOrCreate(
            ['email' => 'showcase@jeweblrystore.com'],
            [
                'name' => 'Showcase',
                'lastNames' => 'Collector',
                'password' => Hash::make('password'),
                'balance' => 10000.00,
                'role' => 'customer',
                'status_id' => $activeStatus->getId(),
            ]
        );

        $category = Category::firstOrCreate(
            ['slug' => 'high-jewelry-showcase'],
            [
                'name' => 'High Jewelry Showcase',
                'description' => 'Exclusive collector pieces curated to highlight top-selling fine jewelry.',
                'status_id' => $activeStatus->getId(),
            ]
        );

        $jewels = [
            ['name' => 'White Gold Engagement Solitaire', 'price' => 3500.00, 'material' => '18k White Gold', 'image' => 'jewel1.jpg', 'description' => 'Hand-forged 18k white gold engagement ring with brilliant diamond.', 'quantity' => 15],
            ['name' => 'Oceanic Ceylon Sapphire Collar', 'price' => 5200.00, 'material' => '950 Platinum', 'image' => 'jewel2.jpg', 'description' => 'Statement collar necklace set with velvety blue sapphires.', 'quantity' => 40],
            ['name' => 'Muzo Emerald Tennis Bracelet', 'price' => 2450.00, 'material' => '18k Yellow Gold', 'image' => 'jewel-seed-1.jpg', 'description' => 'Articulated gold bracelet featuring matched Colombian emeralds.', 'quantity' => 30],
            ['name' => 'Classic Akoya Pearl Drop Earrings', 'price' => 980.00, 'material' => '18k Rose Gold', 'image' => 'jewel3.jpg', 'description' => 'Cultured Akoya pearl drops mounted on rose gold hooks.', 'quantity' => 5],
        ];

        $order = new Order;
        $order->setUserId($user->getId());
        $order->setTotal(0.00);
        $order->setStatusId($approvedStatus->getId());
        $order->save();

        foreach ($jewels as $jewelData) {
            $jewel = Jewel::firstOrCreate(
                ['name' => $jewelData['name']],
                [
                    'price' => $jewelData['price'],
                    'description' => $jewelData['description'],
                    'status_id' => $activeStatus->getId(),
                    'stock' => 25,
                    'material' => $jewelData['material'],
                    'image' => JewelFactory::publishBundledImage($jewelData['image']),
                    'category_id' => $category->getId(),
                ]
            );

            $orderItem = new OrderItem;
            $orderItem->setQuantity($jewelData['quantity']);
            $orderItem->setUnitPrice($jewel->getPrice());
            $orderItem->setJewelId($jewel->getId());
            $orderItem->setOrderId($order->getId());
            $orderItem->save();
        }

        $refreshedOrder = Order::with('items')->findOrFail($order->getId());
        $refreshedOrder->setTotal(round($refreshedOrder->calculateTotal(), 2));
        $refreshedOrder->save();
    }
}
