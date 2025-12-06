<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Rundown;
use App\Models\EventBudgetItem;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a "Past Event"
        $event1 = Event::create([
            'title' => 'Kanvas Art Festival 2024',
            'description' => 'Annual art festival featuring student works.',
            'poster_image' => 'images/poster1.jpg',
            'start_date' => now()->subMonth(),
            'end_date' => now()->subMonth()->addDay(),
            'registration_deadline' => now()->subMonth()->subDays(7),
            'price' => 50000,
            'location' => 'Main Hall',
            'is_active' => false,
        ]);

        // 2. Create an "Upcoming Event"
        $event2 = Event::create([
            'title' => 'Workshop: Digital Painting',
            'description' => 'Learn the basics of digital art with pro artists.',
            'poster_image' => 'images/poster2.jpg',
            'start_date' => now()->addWeeks(2),
            'end_date' => now()->addWeeks(2)->addHours(4),
            'registration_deadline' => now()->addWeek(),
            'price' => 75000,
            'location' => 'Lab Komputer A',
            'is_active' => true,
        ]);

        // --- ADD RUNDOWNS ---
        Rundown::create([
            'event_id' => $event2->id,
            'start_time' => $event2->start_date,
            'end_time' => $event2->start_date->copy()->addHour(),
            'activity' => 'Registration & Setup',
            'person_in_charge' => 'Budi',
        ]);

        Rundown::create([
            'event_id' => $event2->id,
            'start_time' => $event2->start_date->copy()->addHour(),
            'end_time' => $event2->start_date->copy()->addHours(3),
            'activity' => 'Main Workshop Session',
            'person_in_charge' => 'Siska',
        ]);

        // --- ADD BUDGET ITEMS ---
        EventBudgetItem::create([
            'event_id' => $event2->id,
            'type' => 'expense',
            'item_name' => 'Snacks for participants',
            'quantity' => 50,
            'price' => 15000, // Total: 750.000
        ]);

        EventBudgetItem::create([
            'event_id' => $event2->id,
            'type' => 'income',
            'item_name' => 'Sponsorship',
            'quantity' => 1,
            'price' => 2000000,
        ]);
    }
}