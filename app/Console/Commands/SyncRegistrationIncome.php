<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\EventBudgetItem;

class SyncRegistrationIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registration:sync-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all verified registrations to create automatic income entries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Syncing registration income entries...');

        $events = Event::all();
        $synced = 0;
        $skipped = 0;

        foreach ($events as $event) {
            // Get all verified registrations
            $verifiedRegistrations = $event->registrations()
                ->where('payment_status', 'verified')
                ->get();

            $totalCount = $verifiedRegistrations->count();
            $totalAmount = $verifiedRegistrations->sum('amount_paid');

            if ($totalCount > 0) {
                // Calculate average price per registration
                $averagePrice = $totalAmount / $totalCount;

                // Find existing registration income entry
                $registrationIncome = EventBudgetItem::where('event_id', $event->id)
                    ->where('type', 'income')
                    ->where('item_name', 'Biaya Registrasi')
                    ->first();

                if ($registrationIncome) {
                    // Update existing entry
                    $registrationIncome->update([
                        'price' => $averagePrice,
                        'quantity' => $totalCount,
                    ]);
                    $this->info("Updated: {$event->title} - {$totalCount} registrations, Rp " . number_format($totalAmount, 0, ',', '.'));
                } else {
                    // Create new entry
                    EventBudgetItem::create([
                        'event_id' => $event->id,
                        'type' => 'income',
                        'item_name' => 'Biaya Registrasi',
                        'price' => $averagePrice,
                        'quantity' => $totalCount,
                    ]);
                    $this->info("Created: {$event->title} - {$totalCount} registrations, Rp " . number_format($totalAmount, 0, ',', '.'));
                }
                $synced++;
            } else {
                $this->line("Skipped: {$event->title} - No verified registrations");
                $skipped++;
            }
        }

        $this->newLine();
        $this->info("✅ Sync completed!");
        $this->info("Synced: {$synced} events");
        $this->info("Skipped: {$skipped} events (no verified registrations)");

        return Command::SUCCESS;
    }
}
