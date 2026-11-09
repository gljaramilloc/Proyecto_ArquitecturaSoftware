<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExchangeRateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verify that the live USD to COP rate and converted jewel price are displayed in both locales.
     */
    public function test_live_exchange_rate_and_converted_cop_price_are_displayed(): void
    {
        Cache::flush();
        config([
            'services.exchange_rate.url' => 'https://open.er-api.test/v6/latest/USD',
            'services.exchange_rate.cache_ttl' => 3600,
        ]);

        Http::fake([
            'open.er-api.test/*' => Http::response([
                'result' => 'success',
                'time_last_update_utc' => 'Sun, 08 Nov 2026 00:02:31 +0000',
                'base_code' => 'USD',
                'rates' => [
                    'USD' => 1,
                    'COP' => 4200.50,
                ],
            ]),
        ]);

        $status = Status::create(['name' => 'Active']);
        $category = Category::create([
            'name' => 'Rings',
            'description' => 'Handcrafted rings',
            'slug' => 'rings',
            'status_id' => $status->getId(),
        ]);
        $jewel = Jewel::create([
            'name' => 'Imperial Emerald Solitaire',
            'price' => 1000.00,
            'description' => 'Signature Colombian emerald ring.',
            'status_id' => $status->getId(),
            'stock' => 5,
            'material' => '18k Yellow Gold',
            'image' => 'jewels/jewel-seed-2.jpg',
            'category_id' => $category->getId(),
        ]);

        app()->setLocale('es');
        $detailResponse = $this->get(route('jewels.show', $jewel->getId()));
        $detailResponse->assertOk();
        $detailResponse->assertSee('4,200.50');
        $detailResponse->assertSee('4,200,500');
        $detailResponse->assertSee(__('currency.estimated_cop_label'));

        app()->setLocale('en');
        $catalogResponse = $this->get(route('jewels.index'));
        $catalogResponse->assertOk();
        $catalogResponse->assertSee(__('currency.badge_label'));
        $catalogResponse->assertSee('2026-11-08');

        Http::assertSentCount(1);
    }

    /**
     * Verify that a translated fallback notice is shown when the external API fails.
     */
    public function test_graceful_fallback_message_is_shown_when_exchange_rate_api_fails(): void
    {
        Cache::flush();
        config([
            'services.exchange_rate.url' => 'https://open.er-api.test/v6/latest/USD',
            'services.exchange_rate.cache_ttl' => 3600,
        ]);

        Http::fake([
            'open.er-api.test/*' => Http::response(null, 503),
        ]);

        $status = Status::create(['name' => 'Active']);
        $category = Category::create([
            'name' => 'Necklaces',
            'description' => 'Fine necklaces',
            'slug' => 'necklaces',
            'status_id' => $status->getId(),
        ]);
        $jewel = Jewel::create([
            'name' => 'Sapphire Pendant',
            'price' => 850.00,
            'description' => 'Ceylon sapphire necklace.',
            'status_id' => $status->getId(),
            'stock' => 3,
            'material' => '18k White Gold',
            'image' => 'jewels/jewel2.jpg',
            'category_id' => $category->getId(),
        ]);

        $homeResponse = $this->get(route('home.index'));
        $homeResponse->assertOk();
        $homeResponse->assertSee(__('currency.unavailable_short'));

        $detailResponse = $this->get(route('jewels.show', $jewel->getId()));
        $detailResponse->assertOk();
        $detailResponse->assertSee(__('currency.unavailable_detail'));
    }
}
