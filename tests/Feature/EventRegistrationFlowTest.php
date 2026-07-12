<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\Concerns\CreatesUsers;
use Tests\Concerns\FakesCloudinary;
use Tests\TestCase;

class EventRegistrationFlowTest extends TestCase
{
    use CreatesUsers;
    use FakesCloudinary;
    use RefreshDatabase;

    public function test_user_can_register_for_event_with_payment_proof(): void
    {
        $this->fakeCloudinaryUpload();
        $user = $this->makeMember();
        $event = Event::factory()->create(['is_active' => true, 'price' => 50000]);

        $response = $this->actingAs($user)
            ->from(route('events.show', $event))
            ->post(route('events.register', $event), [
                'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
                'phone_number' => '081234567890',
            ]);

        $response->assertRedirect(route('events.show', $event));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('event_registrations', [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'payment_status' => 'pending',
        ]);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'type' => 'registration',
        ]);
        $this->assertEquals('081234567890', $user->fresh()->profile->no_telp);
    }

    public function test_registration_requires_payment_proof(): void
    {
        $user = $this->makeMember();
        $event = Event::factory()->create(['is_active' => true]);

        $this->actingAs($user)
            ->post(route('events.register', $event), [])
            ->assertSessionHasErrors('payment_proof');

        $this->assertDatabaseCount('event_registrations', 0);
    }

    public function test_guest_cannot_register_for_event(): void
    {
        $event = Event::factory()->create(['is_active' => true]);

        $this->post(route('events.register', $event), [
            'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
        ])->assertRedirect(route('login.form'));
    }

    public function test_admin_verification_updates_status_and_creates_income_entry(): void
    {
        $user = $this->makeMember();
        $event = Event::factory()->create(['is_active' => true, 'price' => 50000]);
        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'payment_status' => 'pending',
            'amount_paid' => 50000,
        ]);

        $response = $this->actingAs($this->makeAdmin())
            ->patch(route('admin.registrations.update-status', $registration), [
                'payment_status' => 'verified',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertEquals('verified', $registration->fresh()->payment_status);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'type' => 'payment_verified',
        ]);
        // The automatic income entry for verified registrations
        $this->assertDatabaseHas('event_budget_items', [
            'event_id' => $event->id,
            'type' => 'income',
            'item_name' => 'Biaya Registrasi',
            'quantity' => 1,
        ]);
    }

    public function test_member_cannot_verify_registrations(): void
    {
        $user = $this->makeMember();
        $event = Event::factory()->create(['is_active' => true]);
        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'payment_status' => 'pending',
            'amount_paid' => 0,
        ]);

        $this->actingAs($this->makeMember())
            ->patch(route('admin.registrations.update-status', $registration), [
                'payment_status' => 'verified',
            ])
            ->assertRedirect(route('home'));

        $this->assertEquals('pending', $registration->fresh()->payment_status);
    }
}
