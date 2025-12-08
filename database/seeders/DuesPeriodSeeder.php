<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DuesPeriod;

class DuesPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DuesPeriod::create([
            'name' => 'Kas November 2025',
            'amount' => 20000,
            'due_date' => '2025-11-30',
            'description' => 'Monthly dues for November 2025.',
        ]);

        DuesPeriod::create([
            'name' => 'Kas Desember 2025',
            'amount' => 20000,
            'due_date' => '2025-12-31',
            'description' => 'Monthly dues for December 2025.',
        ]);
    }
}
