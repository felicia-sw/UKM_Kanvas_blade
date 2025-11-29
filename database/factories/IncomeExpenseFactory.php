<?php

namespace Database\Factories;

use App\Models\IncomeExpense;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeExpenseFactory extends Factory
{
    protected $model = IncomeExpense::class;

    public function definition(): array
    {
        $incomeItems = [
            'Sponsorship from Company A',
            'Ticket Sales',
            'Merchandise Sales',
            'Donation',
            'Registration Fees (Manual)',
            'Partnership Revenue',
            'Vendor Booth Fee'
        ];

        $expenseItems = [
            'Venue Rental',
            'Equipment Rental',
            'Decoration Materials',
            'Printing & Documentation',
            'Food & Beverages',
            'Transportation',
            'Staff Payment',
            'Marketing Materials',
            'Sound System',
            'Security Services'
        ];

        $type = $this->faker->randomElement(['income', 'expense']);
        $items = $type === 'income' ? $incomeItems : $expenseItems;

        return [
            'event_id' => Event::factory(),
            'type' => $type,
            'item_name' => $this->faker->randomElement($items),
            'amount' => $this->faker->numberBetween(100000, 5000000),
            'description' => $this->faker->optional(0.6)->sentence(),
            'transaction_date' => $this->faker->dateTimeBetween('-2 months', 'now'),
        ];
    }

    public function income()
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'income',
        ]);
    }

    public function expense()
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'expense',
        ]);
    }
}
