<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventBudgetItem;
use Illuminate\Database\Seeder;

class EventBudgetItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event = Event::first();

        if ($event) {
            EventBudgetItem::create([
                'event_id' => $event->id,
                'type' => 'income',
                'item_name' => 'Ticket Sales',
                'quantity' => 100,
                'price' => 50000,
            ]);

            EventBudgetItem::create([
                'event_id' => $event->id,
                'type' => 'expense',
                'item_name' => 'Venue Rental',
                'quantity' => 1,
                'price' => 2000000,
            ]);

            EventBudgetItem::create([
                'event_id' => $event->id,
                'type' => 'expense',
                'item_name' => 'Snacks and Drinks',
                'quantity' => 100,
                'price' => 15000,
            ]);
        }
    }
}
