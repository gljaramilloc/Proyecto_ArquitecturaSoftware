<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AlliedProductTest extends TestCase
{
    public function test_allied_products_are_listed_when_the_service_responds(): void
    {
        config(['services.allied_store.url' => 'https://allied.test/api/products']);
        Http::fake([
            'allied.test/*' => Http::response([
                ['nombre' => 'Allied Bracelet', 'precio' => 120.5, 'enlace' => 'https://allied.test/products/1'],
            ]),
        ]);

        $response = $this->get(route('alliedProducts.index'));

        $response->assertOk();
        $response->assertSee('Allied Bracelet');
        $response->assertSee('https://allied.test/products/1');
    }

    public function test_an_unavailable_message_is_shown_when_the_service_fails(): void
    {
        config(['services.allied_store.url' => 'https://allied.test/api/products']);
        Http::fake([
            'allied.test/*' => Http::response(null, 500),
        ]);

        $response = $this->get(route('alliedProducts.index'));

        $response->assertOk();
        $response->assertSee(__('allied.unavailable'));
    }
}
