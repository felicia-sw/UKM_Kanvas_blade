<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //  run seeders in ordercuz important for foreign key
        $this->call([
            UserSeeder::class,
            ArtworkCategorySeeder::class,
            ArtworkSeeder::class,
            EventSeeder::class,
            DocumentationSeeder::class,
            IncomeExpenseSeeder::class,
        ]);
    }
}