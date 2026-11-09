<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SeedDataAndJsonApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verify that the JSON service exposes active in-stock jewels with published images.
     */
    public function test_json_service_returns_active_in_stock_seeded_jewels(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $response = $this->getJson(route('api.jewels.index'));

        $response->assertOk();
        $payload = $response->json();

        $this->assertGreaterThanOrEqual(30, count($payload));

        foreach ($payload as $jewelItem) {
            $this->assertGreaterThan(0, $jewelItem['stock']);
            $this->assertStringNotContainsString('placeholder.jpg', $jewelItem['image']);
            $this->assertStringContainsString('/storage/jewels/', $jewelItem['image']);
            $this->assertNotEmpty($jewelItem['name']);
            $this->assertNotEmpty($jewelItem['material']);
            $this->assertNotEmpty($jewelItem['link']);
        }
    }

    /**
     * Verify that seeded catalog, category detail, and admin tables span multiple pages.
     */
    public function test_seeded_data_populates_multiple_pages_across_storefront_and_admin(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $this->get(route('jewels.index', ['page' => 4]))->assertOk();

        $engagementRings = Category::where('slug', 'engagement-rings')->firstOrFail();
        $this->get(route('categories.show', ['id' => $engagementRings->getId(), 'page' => 2]))->assertOk();

        $admin = User::where('email', 'admin@jeweblrystore.com')->firstOrFail();
        $this->actingAs($admin)->get(route('admin.jewels.index', ['page' => 4]))->assertOk();
        $this->actingAs($admin)->get(route('admin.categories.index', ['page' => 2]))->assertOk();
        $this->actingAs($admin)->get(route('admin.users.index', ['page' => 2]))->assertOk();
    }
}
