<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MerchandiseCategory;

class MerchandiseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchandiseCategory::create([
            'name' => 'T-Shirt',
            'description' => 'T-shirts with various designs.',
        ]);

        MerchandiseCategory::create([
            'name' => 'Sticker',
            'description' => 'Stickers with various designs.',
        ]);

        MerchandiseCategory::create([
            'name' => 'Keychain',
            'description' => 'Keychains with various designs.',
        ]);
    }
}