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
        $registrationDeadline = (clone $startDate)->modify('-'.rand(3, 10).' days');
        
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
            'registration_deadline' => $registrationDeadline,
            'price' => $this->faker->optional(0.6)->randomElement([
                100000, 150000, 200000, 250000, null
            ]),
            'location' => $this->faker->optional()->randomElement([
                'Jakarta Convention Center',
                'Bali International Convention Center',
                'Bandung Tech Hub',
                'Surabaya Creative Space',
                'Yogyakarta Convention Hall'
            ]),
            'max_participants' => $this->faker->optional()->randomElement([
                50, 80, 100, 150, 200, 500
            ]),
            'is_active' => $this->faker->boolean(90), // 90% active
        ];
    }
    
    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
        public function inactive()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
