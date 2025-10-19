<?php

namespace Database\Seeders;

use App\Models\ArtworkCategory;
use Illuminate\Database\Seeder;

class ArtworkCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Painting',
            'Digital Art',
            'Sculpture',
            'Photography',
            'Mixed Media',
            'Abstract',
            'Portrait',
            'Landscape',
        ];

        foreach ($categories as $category) {
            ArtworkCategory::create(['name' => $category]);
        }
    }
}
