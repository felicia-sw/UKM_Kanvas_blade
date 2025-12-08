<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Notification::create([
            'user_id' => $user->id,
            'type' => 'event_registration',
            'message' => 'Your registration for the event "UKM Kanvas Open House" has been confirmed.',
            'link_url' => '/events/1',
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $user->id,
            'type' => 'dues_payment',
            'message' => 'Your monthly dues payment for December 2025 has been received.',
            'link_url' => '/dues',
            'is_read' => true,
        ]);
    }
}
