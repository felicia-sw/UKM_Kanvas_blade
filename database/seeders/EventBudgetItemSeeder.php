<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventBudgetItem;
use App\Models\Event;

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
