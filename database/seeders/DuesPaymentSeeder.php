<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DuesPayment;
use App\Models\User;
use App\Models\DuesPeriod;

class DuesPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $duesPeriod = DuesPeriod::first();
        $admin = User::where('email', 'admin@example.com')->first();


        DuesPayment::create([
            'user_id' => $user->id,
            'dues_period_id' => $duesPeriod->id,
            'payment_status' => 'verified',
            'payment_proof' => 'images/payment_proof/dues1.jpg',
            'verified_by' => $admin ? $admin->id : null,
            'verified_at' => now(),
        ]);

        $user = User::skip(1)->first();
        $duesPeriod = DuesPeriod::skip(1)->first();

        if ($user && $duesPeriod) {
            DuesPayment::create([
                'user_id' => $user->id,
                'dues_period_id' => $duesPeriod->id,
                'payment_status' => 'pending',
                'payment_proof' => 'images/payment_proof/dues2.jpg',
            ]);
        }
    }
}
