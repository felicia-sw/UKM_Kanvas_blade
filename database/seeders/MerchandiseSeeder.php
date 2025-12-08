<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;

class MerchandiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat1 = MerchandiseCategory::where('name', 'T-Shirt')->first();
        $cat2 = MerchandiseCategory::where('name', 'Sticker')->first();
        $cat3 = MerchandiseCategory::where('name', 'Keychain')->first();

        Merchandise::create([
            'category_id' => $cat1->id,
            'name' => 'UKM Kanvas T-Shirt',
            'description' => 'Official T-Shirt of UKM Kanvas.',
            'price' => 100000,
            'image_path' => 'images/merchandise/tshirt.jpg',
        ]);

        Merchandise::create([
            'category_id' => $cat2->id,
            'name' => 'UKM Kanvas Sticker Pack',
            'description' => 'A pack of 5 stickers.',
            'price' => 25000,
            'image_path' => 'images/merchandise/sticker.jpg',
        ]);

        Merchandise::create([
            'category_id' => $cat3->id,
            'name' => 'UKM Kanvas Keychain',
            'description' => 'Official Keychain of UKM Kanvas.',
            'price' => 15000,
            'image_path' => 'images/merchandise/keychain.jpg',
        ]);
    }
}