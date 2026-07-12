<?php

namespace Tests\Feature;

use App\Models\DuesPayment;
use App\Models\DuesPeriod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\Concerns\CreatesUsers;
use Tests\Concerns\FakesCloudinary;
use Tests\TestCase;

class DuesPaymentFlowTest extends TestCase
{
    use CreatesUsers;
    use FakesCloudinary;
    use RefreshDatabase;

    private function makePeriod(): DuesPeriod
    {
        return DuesPeriod::create([
            'name' => 'Semester Ganjil 2026',
            'amount' => 50000,
            'due_date' => now()->addMonth(),
            'description' => 'Iuran semester',
        ]);
    }

    public function test_member_can_submit_dues_payment(): void
    {
        $this->fakeCloudinaryUpload();
        $user = $this->makeMember();
        $period = $this->makePeriod();

        $response = $this->actingAs($user)->post(route('dues.payment.store', $period), [
            'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
        ]);

        $response->assertRedirect(route('dues.index'));
        $this->assertDatabaseHas('dues_payments', [
            'user_id' => $user->id,
            'dues_period_id' => $period->id,
            'payment_status' => 'pending',
        ]);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'type' => 'dues_payment',
        ]);
    }

    public function test_member_cannot_pay_the_same_period_twice(): void
    {
        $user = $this->makeMember();
        $period = $this->makePeriod();
        DuesPayment::create([
            'user_id' => $user->id,
            'dues_period_id' => $period->id,
            'payment_status' => 'pending',
        ]);

        $this->actingAs($user)
            ->post(route('dues.payment.store', $period), [
                'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
            ])
            ->assertSessionHas('error');

        $this->assertEquals(1, DuesPayment::count());
    }

    public function test_admin_can_verify_dues_payment(): void
    {
        $user = $this->makeMember();
        $admin = $this->makeAdmin();
        $period = $this->makePeriod();
        $payment = DuesPayment::create([
            'user_id' => $user->id,
            'dues_period_id' => $period->id,
            'payment_status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.dues-payments.verify', $payment), [
                'payment_status' => 'verified',
            ])
            ->assertRedirect();

        $payment->refresh();
        $this->assertEquals('verified', $payment->payment_status);
        $this->assertEquals($admin->id, $payment->verified_by);
        $this->assertNotNull($payment->verified_at);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'type' => 'dues_payment',
        ]);
    }

    public function test_member_cannot_verify_dues_payments(): void
    {
        $user = $this->makeMember();
        $period = $this->makePeriod();
        $payment = DuesPayment::create([
            'user_id' => $user->id,
            'dues_period_id' => $period->id,
            'payment_status' => 'pending',
        ]);

        $this->actingAs($this->makeMember())
            ->patch(route('admin.dues-payments.verify', $payment), [
                'payment_status' => 'verified',
            ])
            ->assertRedirect(route('home'));

        $this->assertEquals('pending', $payment->fresh()->payment_status);
    }

    public function test_dues_index_renders_for_member(): void
    {
        $this->makePeriod();

        $this->actingAs($this->makeMember())
            ->get(route('dues.index'))
            ->assertOk();
    }
}
