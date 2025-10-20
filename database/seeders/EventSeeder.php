<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::factory()
             ->active()
             ->count(10)
             ->create();
        Event::factory()
             ->inactive()
             ->count(3)
             ->create();
    }
}