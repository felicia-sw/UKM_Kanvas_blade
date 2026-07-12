<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use App\Models\MerchandiseOrder;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\Concerns\CreatesUsers;
use Tests\Concerns\FakesCloudinary;
use Tests\TestCase;

class MerchandiseCheckoutTest extends TestCase
{
    use CreatesUsers;
    use FakesCloudinary;
    use RefreshDatabase;

    private User $user;

    private Merchandise $merchandise;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeCloudinaryUpload();

        $this->user = $this->makeMember();
        $category = MerchandiseCategory::create(['name' => 'Apparel']);
        $this->merchandise = Merchandise::create([
            'category_id' => $category->id,
            'name' => 'Tote Bag',
            'description' => 'A bag',
            'price' => 30000,
            'image_path' => 'merch/test.jpg',
            'stock' => 5,
        ]);
    }

    private function fillCart(int $quantity): void
    {
        $cart = ShoppingCart::create(['user_id' => $this->user->id]);
        CartItem::create([
            'shopping_cart_id' => $cart->id,
            'merchandise_id' => $this->merchandise->id,
            'quantity' => $quantity,
        ]);
    }

    public function test_checkout_creates_order_decrements_stock_and_clears_cart(): void
    {
        $this->fillCart(2);

        $response = $this->actingAs($this->user)->post(route('orders.store'), [
            'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
        ]);

        $order = MerchandiseOrder::where('user_id', $this->user->id)->firstOrFail();
        $response->assertRedirect(route('orders.show', $order->id));

        $this->assertEquals(60000, (float) $order->grand_total);
        $this->assertDatabaseHas('merchandise_order_items', [
            'merchandise_order_id' => $order->id,
            'merchandise_id' => $this->merchandise->id,
            'quantity' => 2,
        ]);
        $this->assertEquals(3, $this->merchandise->fresh()->stock);
        $this->assertDatabaseCount('cart_items', 0);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->user->id,
            'type' => 'merchandise_order',
        ]);
    }

    public function test_checkout_with_empty_cart_redirects_back_to_cart(): void
    {
        $this->actingAs($this->user)
            ->post(route('orders.store'), [
                'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
            ])
            ->assertRedirect(route('cart.index'));

        $this->assertDatabaseCount('merchandise_orders', 0);
    }

    public function test_checkout_fails_when_stock_is_insufficient(): void
    {
        $this->fillCart(9); // stock is 5

        $this->actingAs($this->user)
            ->post(route('orders.store'), [
                'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
            ])
            ->assertRedirect(route('cart.index'));

        $this->assertDatabaseCount('merchandise_orders', 0);
        $this->assertEquals(5, $this->merchandise->fresh()->stock);
    }

    public function test_admin_payment_verification_updates_status_and_notifies(): void
    {
        $this->fillCart(1);
        $this->actingAs($this->user)->post(route('orders.store'), [
            'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
        ]);
        $order = MerchandiseOrder::firstOrFail();

        $this->actingAs($this->makeAdmin())
            ->patch(route('admin.orders.verify-payment', $order), [
                'payment_status' => 'verified',
            ])
            ->assertRedirect();

        $this->assertEquals('verified', $order->fresh()->payment_status);
    }
}
