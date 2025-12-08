<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CartItem;
use App\Models\ShoppingCart;
use App\Models\Merchandise;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shoppingCart = ShoppingCart::first();
        $merchandise1 = Merchandise::first();
        $merchandise2 = Merchandise::skip(1)->first();

        if ($shoppingCart && $merchandise1) {
            CartItem::create([
                'shopping_cart_id' => $shoppingCart->id,
                'merchandise_id' => $merchandise1->id,
                'quantity' => 2,
            ]);
        }
        
        if ($shoppingCart && $merchandise2) {
            CartItem::create([
                'shopping_cart_id' => $shoppingCart->id,
                'merchandise_id' => $merchandise2->id,
                'quantity' => 1,
            ]);
        }
    }
}
