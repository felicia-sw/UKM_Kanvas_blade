<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Concerns\CreatesUsers;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use CreatesUsers;
    use RefreshDatabase;

    private function memberWithProfile(): User
    {
        $user = $this->makeMember();
        Profile::create([
            'user_id' => $user->id,
            'nim' => '20251234',
            'jurusan' => 'DKV',
            'asal_universitas' => 'Universitas Kanvas',
            'no_telp' => '081234567890',
        ]);

        return $user;
    }

    public function test_profile_page_renders(): void
    {
        $this->actingAs($this->memberWithProfile())
            ->get(route('profile.show'))
            ->assertOk();
    }

    public function test_user_can_update_profile(): void
    {
        $user = $this->memberWithProfile();

        $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => $user->email,
            'nim' => '20259999',
            'jurusan' => 'Informatika',
            'asal_universitas' => 'Universitas Kanvas',
            'no_telp' => '089999999999',
        ])->assertRedirect();

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('20259999', $user->profile->nim);
    }

    public function test_user_can_change_password_with_correct_current_password(): void
    {
        $user = $this->makeMember();
        $user->update(['password' => Hash::make('old-password')]);

        $this->actingAs($user)->put(route('profile.update-password'), [
            'current_password' => 'old-password',
            'new_password' => 'new-password-123',
            'new_password_confirmation' => 'new-password-123',
        ])->assertRedirect();

        $this->assertTrue(Hash::check('new-password-123', $user->fresh()->password));
    }

    public function test_password_change_rejects_wrong_current_password(): void
    {
        $user = $this->makeMember();
        $user->update(['password' => Hash::make('old-password')]);

        $this->actingAs($user)->put(route('profile.update-password'), [
            'current_password' => 'wrong-password',
            'new_password' => 'new-password-123',
            'new_password_confirmation' => 'new-password-123',
        ]);

        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }
}
