<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there is at least one status (normally created by StatusSeeder)
        $status = Status::firstOrCreate(['id' => 1], ['name' => 'Pending']);

        // Pick or create a generic user to attach the mock order to
        $user = User::firstOrCreate([
            'email' => 'testuser@jewelstore.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password123'),
            'balance' => 0,
            'role' => 'client',
        ]);

        $category = new Category;
        $category->setName('Anillos Premium');
        $category->setDescription('Colección exclusiva de anillos premium.');
        $category->setSlug('anillos-premium');
        $category->setStatusId($status->getId());
        $category->save();

        // MOCK JEWELS
        $jewels = [
            ['name' => '💍 Anillo de Compromiso Oro Blanco', 'price' => 3500.00, 'material' => 'Oro Blanco', 'image' => 'anillo.jpg', 'desc' => 'Anillo 18k premium.'],
            ['name' => '💎 Collar de Zafiro Oceánico', 'price' => 5200.00, 'material' => 'Plata/Zafiro', 'image' => 'collar.jpg', 'desc' => 'Collar elegante.'],
            ['name' => '✨ Pulsera Esmeralda Elegancia', 'price' => 1250.00, 'material' => 'Esmeralda', 'image' => 'pulsera.jpg', 'desc' => 'Pulsera importada.'],
            ['name' => '👑 Pendientes Perla Clásica', 'price' => 850.00, 'material' => 'Perla', 'image' => 'perla.jpg', 'desc' => 'Perlas cultivadas.'],
        ];

        $jewelModels = [];
        foreach ($jewels as $j) {
            $jewel = Jewel::firstOrCreate(
                ['name' => $j['name']],
                [
                    'price' => $j['price'],
                    'description' => $j['desc'],
                    'status_id' => $status->getId(),
                    'stock' => 50,
                    'material' => $j['material'],
                    'image' => $j['image'],
                    'category_id' => $category->getId(),
                ]
            );
            $jewelModels[] = $jewel;
        }

        // MOCK ORDER (to simulate they were purchased heavily)
        $order = new Order;
        $order->setUserId($user->getId());
        // Random total, just a mock
        $order->setTotal(50000.00);
        $order->setStatusId($status->getId());
        $order->save();

        // MOCK ORDER ITEMS to satisfy the top 3 logic.
        // We will "sell" differing quantities so the order is obvious:
        // 1st place: Zafiro (40 units)
        // 2nd place: Pulsera (30 units)
        // 3rd place: Anillo (15 units)
        // 4th place (wont show in top3): Pendientes (5 units)

        $quantities = [15, 40, 30, 5]; // matches the array order above

        foreach ($jewelModels as $index => $jewelModel) {
            $orderItem = new OrderItem;
            $orderItem->setQuantity($quantities[$index]);
            $orderItem->setUnitPrice($jewelModel->getPrice());
            $orderItem->setJewelId($jewelModel->getId());
            $orderItem->setOrderId($order->getId());
            $orderItem->save();
        }
    }
}
