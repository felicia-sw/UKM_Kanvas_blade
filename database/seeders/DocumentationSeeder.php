<?php

namespace Database\Seeders;

use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Database\Seeder;

class DocumentationSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();
        
        foreach ($events as $event) {
            // Create 3-8 documentation photos per event
            Documentation::factory()
                        ->count(rand(3, 8))
                        ->create(['event_id' => $event->id]);
        }
    }
}
