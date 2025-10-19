<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Checking Artworks and Categories ===\n\n";

// Check artworks without categories
$artworksWithoutCategory = App\Models\Artwork::whereNull('category_id')->get();
echo "Artworks with NULL category_id: " . $artworksWithoutCategory->count() . "\n";
if ($artworksWithoutCategory->count() > 0) {
    foreach ($artworksWithoutCategory as $artwork) {
        echo "  - ID: {$artwork->id}, Title: {$artwork->title}\n";
    }
}
echo "\n";

// Check all artworks and their categories
$allArtworks = App\Models\Artwork::with('category')->get();
echo "All Artworks:\n";
foreach ($allArtworks as $artwork) {
    $categoryName = $artwork->category ? $artwork->category->name : 'NULL';
    echo "  - ID: {$artwork->id}, Title: {$artwork->title}, Category: {$categoryName}\n";
}
echo "\nTotal artworks: " . $allArtworks->count() . "\n\n";

// Check all categories
$categories = App\Models\ArtworkCategory::all();
echo "All Categories:\n";
foreach ($categories as $category) {
    $count = App\Models\Artwork::where('category_id', $category->id)->count();
    echo "  - {$category->name} (ID: {$category->id}): {$count} artworks\n";
}
