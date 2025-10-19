<?php

namespace Database\Factories;

use App\Models\Artwork;
use App\Models\ArtworkCategory; // related to artwork
use Illuminate\Database\Eloquent\Factories\Factory; //base factory class

class ArtworkFactory extends Factory // extends the factory base
{
    protected $model = Artwork::class; // $model tells laravel: this factory creates artwork records 

    public function definition(): array // laravel calls definition() whenever you generate or seed an artwork; returns an array mapping each column name to a fake value
    {
        return [ // rturns an array mapping each column name to a fake value 
            'title' => $this->faker->sentence(3), // returns 3 word title
            'description' => $this->faker->optional()->paragraph(), // sometimes paragraph, sometimes null
            'image_path' => 'artworks/' . $this->faker->uuid() . '.jpg', //unique identifier for an image filename
            'artist_name' => $this->faker->name(), // 
            'category_id' => ArtworkCategory::factory(), // instead of picking a random existing category ID, laravel automatically create a new artworkcategory record via its factory and use its primary key
            'created_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}