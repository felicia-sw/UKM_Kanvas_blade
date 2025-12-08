<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rundown;
use App\Models\Event;

class RundownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event = Event::first();

        if ($event) {
            Rundown::create([
                'event_id' => $event->id,
                'start_time' => '2025-12-10 09:00:00',
                'end_time' => '2025-12-10 10:00:00',
                'activity' => 'Opening Ceremony',
                'description' => 'Opening speech by the chairman.',
                'person_in_charge' => 'John Doe',
            ]);

            Rundown::create([
                'event_id' => $event->id,
                'start_time' => '2025-12-10 10:00:00',
                'end_time' => '2025-12-10 12:00:00',
                'activity' => 'Workshop Session 1',
                'description' => 'Workshop on digital painting.',
                'person_in_charge' => 'Jane Doe',
            ]);
        }
    }
}
