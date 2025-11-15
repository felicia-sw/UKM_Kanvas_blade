<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Notification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send event reminder notifications to registered users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        // Get events starting tomorrow (1 day before reminder)
        $eventsTomorrow = Event::whereDate('start_date', $tomorrow)
            ->where('is_active', true)
            ->get();

        foreach ($eventsTomorrow as $event) {
            $registrations = EventRegistration::where('event_id', $event->id)
                ->where('payment_status', 'verified')
                ->get();

            foreach ($registrations as $registration) {
                // Check if notification already sent
                $exists = Notification::where('user_id', $registration->user_id)
                    ->where('event_id', $event->id)
                    ->where('type', 'reminder_1day')
                    ->exists();

                if (!$exists) {
                    Notification::create([
                        'user_id' => $registration->user_id,
                        'event_id' => $event->id,
                        'type' => 'reminder_1day',
                        'message' => "Reminder: {$event->title} is tomorrow! Don't forget to attend.",
                    ]);
                }
            }
        }

        // Get events starting today (day of reminder)
        $eventsToday = Event::whereDate('start_date', $today)
            ->where('is_active', true)
            ->get();

        foreach ($eventsToday as $event) {
            $registrations = EventRegistration::where('event_id', $event->id)
                ->where('payment_status', 'verified')
                ->get();

            foreach ($registrations as $registration) {
                // Check if notification already sent
                $exists = Notification::where('user_id', $registration->user_id)
                    ->where('event_id', $event->id)
                    ->where('type', 'reminder_today')
                    ->exists();

                if (!$exists) {
                    Notification::create([
                        'user_id' => $registration->user_id,
                        'event_id' => $event->id,
                        'type' => 'reminder_today',
                        'message' => "Today is the day! {$event->title} is happening today at {$event->location}.",
                    ]);
                }
            }
        }

        $this->info('Event reminders sent successfully!');
        return 0;
    }
}
