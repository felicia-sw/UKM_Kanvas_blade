<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create the Admin User
        User::create([
            'name' => 'Admin Kanvas',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminKanvas123'), // Hash the password
            'is_admin' => true, // Set as admin
            'email_verified_at' => now(),
        ]);

        // Optional: Create a regular test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'), // Default password
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Optional: Create more random users
        // User::factory(10)->create();
    }
}