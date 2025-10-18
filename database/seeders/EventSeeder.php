<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 active events
        Event::factory()
             ->active()
             ->count(10)
             ->create();
        
        // Create 3 inactive events
        Event::factory()
             ->inactive()
             ->count(3)
             ->create();
    }
}