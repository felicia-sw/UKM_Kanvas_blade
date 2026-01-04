<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArtworkCategory;

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
    if (!ArtworkCategory::where('name', $category)->exists()) {
        ArtworkCategory::create(['name' => $category]);
    }
}

echo "Artwork categories populated successfully.\n";

