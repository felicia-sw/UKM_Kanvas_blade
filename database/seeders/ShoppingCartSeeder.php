<?php

namespace Database\Seeders;

use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            ShoppingCart::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
