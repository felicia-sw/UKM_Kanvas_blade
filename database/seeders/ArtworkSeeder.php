<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\ArtworkCategory;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist
        $cat1 = ArtworkCategory::firstOrCreate(['name' => 'Painting']);
        $cat2 = ArtworkCategory::firstOrCreate(['name' => 'Digital']);

        Artwork::create([
            'user_id' => 1, // <--- CRITICAL: Must link to a valid user
            'category_id' => $cat1->id,
            'title' => 'Sunset over Kampus',
            'description' => 'Oil on canvas painting.',
            'image_path' => 'images/art1.jpg',
            'artist_name' => 'Andi Painter',
            'created_date' => now()->subDays(5),
        ]);

        Artwork::create([
            'user_id' => 1,
            'category_id' => $cat2->id,
            'title' => 'Future City',
            'description' => 'Concept art for game design.',
            'image_path' => 'images/art2.jpg',
            'artist_name' => 'Siti Digital',
            'created_date' => now()->subDays(2),
        ]);
    }
}