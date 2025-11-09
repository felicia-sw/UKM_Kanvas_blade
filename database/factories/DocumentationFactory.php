<?php

namespace Database\Factories;

use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentationFactory extends Factory
{
    protected $model = Documentation::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->optional()->sentence(3),
            'file_path' => 'documentation/' . $this->faker->uuid() . '.jpg',
            'event_id' => Event::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
