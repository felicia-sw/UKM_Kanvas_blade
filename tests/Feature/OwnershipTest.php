<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use App\Models\MerchandiseOrder;
use App\Models\Notification;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesUsers;
use Tests\TestCase;

class OwnershipTest extends TestCase
{
    use CreatesUsers;
    use RefreshDatabase;

    private function makeOrderFor(User $user): MerchandiseOrder
    {
        return MerchandiseOrder::create([
            'user_id' => $user->id,
            'grand_total' => 50000,
            'payment_status' => 'pending',
            'pickup_status' => 'pending',
        ]);
    }

    public function test_user_cannot_view_someone_elses_order(): void
    {
        $owner = $this->makeMember();
        $intruder = $this->makeMember();
        $order = $this->makeOrderFor($owner);

        $this->actingAs($intruder)->get(route('orders.show', $order))->assertForbidden();
        $this->actingAs($owner)->get(route('orders.show', $order))->assertOk();
    }

    public function test_admin_can_view_any_order(): void
    {
        $order = $this->makeOrderFor($this->makeMember());

        $this->actingAs($this->makeAdmin())->get(route('orders.show', $order))->assertOk();
    }

    public function test_user_cannot_mark_someone_elses_notification_read(): void
    {
        $owner = $this->makeMember();
        $intruder = $this->makeMember();
        $notification = Notification::create([
            'user_id' => $owner->id,
            'type' => 'registration',
            'message' => 'Test notification',
            'is_read' => false,
        ]);

        $this->actingAs($intruder)
            ->patch(route('notifications.mark-read', $notification))
            ->assertForbidden();

        $this->actingAs($owner)
            ->patch(route('notifications.mark-read', $notification))
            ->assertRedirect();

        $this->assertTrue($notification->fresh()->is_read);
    }

    public function test_user_cannot_touch_someone_elses_cart_item(): void
    {
        $owner = $this->makeMember();
        $intruder = $this->makeMember();

        $category = MerchandiseCategory::create(['name' => 'Apparel']);
        $merchandise = Merchandise::create([
            'category_id' => $category->id,
            'name' => 'T-Shirt',
            'description' => 'A shirt',
            'price' => 75000,
            'image_path' => 'merch/test.jpg',
            'stock' => 10,
        ]);
        $cart = ShoppingCart::create(['user_id' => $owner->id]);
        $item = CartItem::create([
            'shopping_cart_id' => $cart->id,
            'merchandise_id' => $merchandise->id,
            'quantity' => 1,
        ]);

        $this->actingAs($intruder)
            ->patch(route('cart.update', $item), ['quantity' => 2])
            ->assertForbidden();

        $this->actingAs($intruder)
            ->delete(route('cart.remove', $item))
            ->assertForbidden();

        $this->assertDatabaseHas('cart_items', ['id' => $item->id, 'quantity' => 1]);
    }
}
