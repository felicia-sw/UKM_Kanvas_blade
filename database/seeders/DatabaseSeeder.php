<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // The order is important! Roles must exist before Users.
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            // You can uncomment these later if you want dummy events/art
            // EventSeeder::class,
            // ArtworkSeeder::class,
        ]);
    }
}