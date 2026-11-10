<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomeBannerAndAdminUsabilityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verify that the home page renders the footer slogan and promotional banners in Spanish and English.
     */
    public function test_home_page_renders_promotional_banners_in_both_locales(): void
    {
        foreach (['es', 'en'] as $locale) {
            app()->setLocale($locale);

            $response = $this->get(route('home.index'));

            $response->assertOk();
            $response->assertSee(__('navigation.footer_slogan'));
            $response->assertSee(__('home.promo_banner_kicker'));
            $response->assertSee(__('home.promo_banner_title'));
            $response->assertSee(__('home.promo_banner_cta'));
            $response->assertSee(__('home.promo_banner_secondary_cta'));
        }
    }

    /**
     * Verify that updating a category preserves its own slug and admin deletions guard foreign keys safely.
     */
    public function test_admin_forms_and_deletions_handle_validation_and_foreign_key_guards_gracefully(): void
    {
        Storage::fake('public');

        $activeStatus = Status::create(['name' => 'Active']);
        $pendingStatus = Status::create(['name' => 'Pending']);
        $admin = User::factory()->admin()->create(['status_id' => $activeStatus->getId()]);

        $category = Category::create([
            'name' => 'Engagement Rings',
            'description' => 'Signature rings',
            'slug' => 'engagement-rings',
            'status_id' => $activeStatus->getId(),
        ]);

        // Updating a category keeping the same slug succeeds without false unique collision
        $this->actingAs($admin)
            ->put(route('admin.categories.update', $category->getId()), [
                'name' => 'Fine Engagement Rings',
                'description' => 'Updated signature rings',
                'slug' => 'engagement-rings',
                'status_id' => $activeStatus->getId(),
            ])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertSame('Fine Engagement Rings', $category->fresh()->getName());

        // Creating a jewel without an image fails validation cleanly instead of throwing 500
        $this->actingAs($admin)
            ->post(route('admin.jewels.store'), [
                'name' => 'Imageless Ring',
                'price' => 1200,
                'description' => 'Missing image test',
                'status_id' => $activeStatus->getId(),
                'stock' => 5,
                'material' => '18k Gold',
                'category_id' => $category->getId(),
            ])
            ->assertSessionHasErrors(['image']);

        Storage::disk('public')->put('jewels/shared.jpg', 'image-bytes');

        $orderedJewel = Jewel::create([
            'name' => 'Ordered Ring',
            'price' => 2500,
            'description' => 'Ring with order history',
            'status_id' => $activeStatus->getId(),
            'stock' => 4,
            'material' => '950 Platinum',
            'image' => 'jewels/shared.jpg',
            'category_id' => $category->getId(),
        ]);

        // Deleting a category that still has jewels redirects with a flash error instead of 500
        $this->actingAs($admin)
            ->delete(route('admin.categories.destroy', $category->getId()))
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('error', __('admin.cannot_delete_category_with_jewels'));

        $order = new Order;
        $order->setUserId($admin->getId());
        $order->setTotal(2500);
        $order->setStatusId($pendingStatus->getId());
        $order->save();

        $orderItem = new OrderItem;
        $orderItem->setOrderId($order->getId());
        $orderItem->setJewelId($orderedJewel->getId());
        $orderItem->setQuantity(1);
        $orderItem->setUnitPrice(2500);
        $orderItem->save();

        // Deleting an ordered jewel redirects with a flash error and keeps its image on disk
        $this->actingAs($admin)
            ->delete(route('admin.jewels.destroy', $orderedJewel->getId()))
            ->assertRedirect(route('admin.jewels.index'))
            ->assertSessionHas('error', __('admin.cannot_delete_jewel_with_orders'));

        Storage::disk('public')->assertExists('jewels/shared.jpg');
        $this->assertDatabaseHas('jewels', ['id' => $orderedJewel->getId()]);
    }
}
