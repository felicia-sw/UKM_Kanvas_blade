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
            ArtworkCategorySeeder::class,
            EventSeeder::class,
            ArtworkSeeder::class,
            DocumentationSeeder::class,
            IncomeExpenseSeeder::class,
        ]);
    }
}