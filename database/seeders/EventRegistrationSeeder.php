<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventRegistration;
use App\Models\User;
use App\Models\Event;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $event = Event::first();

        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'payment_proof' => 'images/payment_proof/proof1.jpg',
            'payment_status' => 'verified',
            'amount_paid' => 50000,
        ]);

        $user = User::skip(1)->first();
        $event = Event::skip(1)->first();

        if ($user && $event) {
            EventRegistration::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'payment_proof' => 'images/payment_proof/proof2.jpg',
                'payment_status' => 'pending',
                'amount_paid' => 75000,
            ]);
        }
    }
}
