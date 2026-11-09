<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\DummyDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
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
        Storage::fake('local');
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
     * Verify that seeded catalog, category detail, payments, and admin tables are domain-consistent.
     */
    public function test_seeded_data_populates_multiple_pages_and_valid_payments(): void
    {
        Storage::fake('public');
        Storage::fake('local');
        $this->seed(DatabaseSeeder::class);

        $this->get(route('jewels.index', ['page' => 4]))->assertOk();

        $engagementRings = Category::where('slug', 'engagement-rings')->firstOrFail();
        $this->get(route('categories.show', ['id' => $engagementRings->getId(), 'page' => 2]))->assertOk();

        $admin = User::where('email', 'admin@jeweblrystore.com')->firstOrFail();
        $this->actingAs($admin)->get(route('admin.jewels.index', ['page' => 4]))->assertOk();
        $this->actingAs($admin)->get(route('admin.categories.index', ['page' => 2]))->assertOk();
        $this->actingAs($admin)->get(route('admin.users.index', ['page' => 2]))->assertOk();

        $demoCustomer = User::where('email', 'customer@jeweblrystore.com')->firstOrFail();
        $demoOrders = Order::with('payment')->where('user_id', $demoCustomer->getId())->get();
        $this->assertCount(4, $demoOrders);

        foreach (Payment::with('order')->get() as $payment) {
            $this->assertContains($payment->getMethod(), [Payment::METHOD_BALANCE, Payment::METHOD_CHEQUE]);
            $orderDay = Carbon::parse($payment->getOrder()->getCreatedAt())->format('Y-m-d');
            $this->assertGreaterThanOrEqual($orderDay, $payment->getDate());

            if ($payment->isCheque()) {
                Storage::disk('local')->assertExists($payment->getChequePath());
            }
        }

        $this->seed(DummyDataSeeder::class);
        $orderCountAfterFirstDummyRun = Order::query()->count();
        $this->seed(DummyDataSeeder::class);
        $this->assertSame($orderCountAfterFirstDummyRun, Order::query()->count());
    }
}
