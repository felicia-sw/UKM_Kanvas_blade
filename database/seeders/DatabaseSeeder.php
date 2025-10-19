<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run seeders in order (important for foreign keys!)
        $this->call([
            ArtworkCategorySeeder::class,
            ArtworkSeeder::class,
            EventSeeder::class,
            DocumentationSeeder::class,
        ]);
    }
}