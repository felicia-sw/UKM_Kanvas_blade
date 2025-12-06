<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_cart_id',
        'merchandise_id',
        'quantity',
    ];

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    public function merchandise()
    {
        return $this->belongsTo(Merchandise::class);
    }
}