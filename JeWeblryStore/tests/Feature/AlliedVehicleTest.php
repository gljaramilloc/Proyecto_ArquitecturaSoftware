<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AlliedVehicleTest extends TestCase
{
    public function test_allied_vehicles_are_listed_when_the_service_responds(): void
    {
        config(['services.allied_vehicles.url' => 'https://allied.test/api/vehiculos']);
        Http::fake([
            'allied.test/*' => Http::response([
                'data' => [
                    [
                        'id' => 1,
                        'make' => 'Toyota',
                        'model' => 'Corolla',
                        'category' => 'Sedan',
                        'location' => ['name' => 'Sede El Poblado', 'city' => 'Medellín', 'address' => 'Carrera 43A # 1-50'],
                        'daily_rate' => 95000,
                        'currency' => 'COP',
                        'availability' => true,
                        'detail_url' => 'https://allied.test/vehicles/1',
                    ],
                ],
                'availability_basis' => 'today',
            ]),
        ]);

        $response = $this->get(route('alliedVehicles.index'));

        $response->assertOk();
        $response->assertSee('Toyota Corolla');
        $response->assertSee('Sede El Poblado');
        $response->assertSee('$95.000');
        $response->assertSee('https://allied.test/vehicles/1');
    }

    public function test_an_unavailable_message_is_shown_when_the_service_fails(): void
    {
        config(['services.allied_vehicles.url' => 'https://allied.test/api/vehiculos']);
        Http::fake([
            'allied.test/*' => Http::response(null, 500),
        ]);

        $response = $this->get(route('alliedVehicles.index'));

        $response->assertOk();
        $response->assertSee(__('allied.unavailable'));
    }
}
