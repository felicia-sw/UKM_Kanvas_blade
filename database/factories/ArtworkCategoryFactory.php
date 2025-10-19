<?php

namespace Database\Factories; // puts factory in the Database\Factories namespace so that it can be autodiscovered by laravel
use App\Models\ArtworkCategory; // import artworkcategory model
use Illuminate\Database\Eloquent\Factories\Factory; // imports related 

class ArtworkCategoryFactory extends Factory
{
    protected $model = ArtworkCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Painting',
                'Digital Art',
                'Sculpture',
                'Photography',
                'Mixed Media',
                'Abstract',
                'Portrait',
                'Landscape'
            ]),
        ];
    }
}

