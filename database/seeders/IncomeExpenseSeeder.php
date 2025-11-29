<?php

namespace Database\Seeders;

use App\Models\IncomeExpense;
use App\Models\Event;
use Illuminate\Database\Seeder;

class IncomeExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();
        
        foreach ($events as $event) {
            // Create 2-5 income entries per event
            IncomeExpense::factory()
                ->income()
                ->count(rand(2, 5))
                ->create(['event_id' => $event->id]);
            
            // Create 3-8 expense entries per event
            IncomeExpense::factory()
                ->expense()
                ->count(rand(3, 8))
                ->create(['event_id' => $event->id]);
        }
    }
}
