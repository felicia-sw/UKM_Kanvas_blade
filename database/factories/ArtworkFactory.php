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
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'image_path' => 'artworks/' . $this->faker->uuid() . '.jpg',
            'artist_name' => $this->faker->name(),
            'category_id' => ArtworkCategory::factory(),
            'created_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}