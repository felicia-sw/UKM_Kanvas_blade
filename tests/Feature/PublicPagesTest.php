<?php

namespace Tests\Feature;

use App\Models\Artwork;
use App\Models\ArtworkCategory;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_for_guests(): void
    {
        foreach (['/', '/events', '/art-gallery', '/merchandise', '/about'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_event_detail_page_renders_via_route_model_binding(): void
    {
        $event = Event::factory()->create(['is_active' => true]);

        $this->get(route('events.show', $event))->assertOk();
        $this->get(route('events.documentation', $event))->assertOk();
    }

    public function test_missing_event_returns_404(): void
    {
        $this->get('/events/999999')->assertNotFound();
    }

    public function test_artwork_detail_page_renders_via_route_model_binding(): void
    {
        $category = ArtworkCategory::create(['name' => 'Painting']);
        $artwork = Artwork::factory()->create(['category_id' => $category->id]);

        $this->get(route('artworks.show', $artwork))->assertOk();
    }

    public function test_missing_artwork_returns_404(): void
    {
        $this->get('/artworks/999999')->assertNotFound();
    }

    public function test_events_index_handles_all_filter_values(): void
    {
        Event::factory()->create(['is_active' => true]);

        foreach (['upcoming', 'past', 'all', 'nonsense'] as $filter) {
            $this->get("/events?filter={$filter}")->assertOk();
        }
    }
}
