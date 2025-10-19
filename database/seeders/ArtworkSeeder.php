<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ArtworkCategory::all();

        // Create 30 artworks with random categories
        Artwork::factory()
            ->count(30)
            ->create([
                'category_id' => $categories->random()->id
            ]);
    }
}
