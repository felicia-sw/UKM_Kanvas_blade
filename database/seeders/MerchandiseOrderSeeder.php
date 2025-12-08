<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MerchandiseOrder;
use App\Models\User;

class MerchandiseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        MerchandiseOrder::create([
            'user_id' => $user->id,
            'grand_total' => 115000,
            'payment_proof' => 'images/payment_proof/order1.jpg',
            'payment_status' => 'verified',
            'verified_at' => now(),
            'pickup_status' => 'pending',
        ]);

        $user = User::skip(1)->first();
        if ($user) {
            MerchandiseOrder::create([
                'user_id' => $user->id,
                'grand_total' => 25000,
                'payment_proof' => 'images/payment_proof/order2.jpg',
                'payment_status' => 'pending',
                'pickup_status' => 'pending',
            ]);
        }
    }
}
