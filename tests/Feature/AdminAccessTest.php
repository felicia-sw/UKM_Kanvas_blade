<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesUsers;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use CreatesUsers;
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin/dashboard')->assertRedirect(route('login.form'));
    }

    public function test_member_is_redirected_away_with_error(): void
    {
        $this->actingAs($this->makeMember())
            ->get('/admin/dashboard')
            ->assertRedirect(route('home'));
    }

    public function test_admin_can_open_dashboard_and_resource_pages(): void
    {
        $admin = $this->makeAdmin();

        foreach (['/admin/dashboard', '/admin/artworks', '/admin/events', '/admin/merchandise', '/admin/orders', '/admin/dues'] as $path) {
            $this->actingAs($admin)->get($path)->assertOk();
        }
    }

    public function test_member_cannot_export_event_finances(): void
    {
        $this->actingAs($this->makeMember())
            ->get('/export/1')
            ->assertRedirect(route('home'));
    }
}
