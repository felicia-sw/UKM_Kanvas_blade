<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchandise_order_id',
        'merchandise_id',
        'quantity',
        'price_at_purchase',
    ];

    protected $casts = [
        'price_at_purchase' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(MerchandiseOrder::class, 'merchandise_order_id');
    }

    public function merchandise()
    {
        // We use withTrashed() in case the product is deleted later, 
        // we still want to see what it was in history.
        return $this->belongsTo(Merchandise::class)->withTrashed();
    }
}