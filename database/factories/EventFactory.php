<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+6 months');
$endDate = (clone $startDate)->modify('+'.rand(1, 14).' days');

        
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'poster_image' => $this->faker->optional()->randomElement([
                'events/poster1.jpg',
                'events/poster2.jpg',
                null
            ]),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => $this->faker->optional()->address(),
            'is_active' => $this->faker->boolean(90), // 90% active
        ];
    }
    
    // State for active events
    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
    
    // State for inactive events
    public function inactive()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
