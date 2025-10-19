<?php

namespace Database\Factories;

use App\Models\Artwork;
use App\Models\ArtworkCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtworkFactory extends Factory
{
    protected $model = Artwork::class;

    public function definition(): array
    {
        // Sample artwork titles that sound more artistic
        $artworkPrefixes = [
            'Abstract', 'Modern', 'Sunset', 'Urban', 'Dreams of', 'Whispers of',
            'The Beauty of', 'Reflections on', 'Colors of', 'Essence of',
            'Journey Through', 'Vision of', 'Fragments of', 'Portrait of'
        ];
        
        $artworkSubjects = [
            'Nature', 'City Life', 'Humanity', 'Freedom', 'Tomorrow',
            'the Ocean', 'the Night', 'Hope', 'Memories', 'Silence',
            'the Soul', 'Time', 'Peace', 'Chaos', 'Light'
        ];
        
        $title = $this->faker->randomElement($artworkPrefixes) . ' ' . 
                 $this->faker->randomElement($artworkSubjects);
        
        return [
            'title' => $title,
            'description' => $this->faker->optional(0.7)->paragraph(),
            'image_path' => 'images/gallery/artwork' . $this->faker->numberBetween(1, 9) . '.jpg',
            'artist_name' => $this->faker->name(),
            'category_id' => ArtworkCategory::factory(),
            'created_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}