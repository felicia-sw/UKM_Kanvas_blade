<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kanvas',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminKanvas123'), 
            'is_admin' => true, 
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'), 
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

    }
}