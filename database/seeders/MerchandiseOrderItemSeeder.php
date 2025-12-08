<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MerchandiseOrderItem;
use App\Models\MerchandiseOrder;
use App\Models\Merchandise;

class MerchandiseOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order1 = MerchandiseOrder::first();
        $merchandise1 = Merchandise::first();
        $merchandise2 = Merchandise::skip(1)->first();

        if ($order1 && $merchandise1 && $merchandise2) {
            MerchandiseOrderItem::create([
                'merchandise_order_id' => $order1->id,
                'merchandise_id' => $merchandise1->id,
                'quantity' => 1,
                'price_at_purchase' => 100000,
            ]);
            MerchandiseOrderItem::create([
                'merchandise_order_id' => $order1->id,
                'merchandise_id' => $merchandise2->id,
                'quantity' => 1,
                'price_at_purchase' => 15000,
            ]);
        }


        $order2 = MerchandiseOrder::skip(1)->first();
        $merchandise3 = Merchandise::skip(2)->first();

        if ($order2 && $merchandise3) {
            MerchandiseOrderItem::create([
                'merchandise_order_id' => $order2->id,
                'merchandise_id' => $merchandise3->id,
                'quantity' => 1,
                'price_at_purchase' => 15000,
            ]);
        }
    }
}
