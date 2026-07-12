<?php

namespace Database\Seeders;

use App\Models\MerchandiseCategory;
use Illuminate\Database\Seeder;

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
