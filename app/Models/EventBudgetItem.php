<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBudgetItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'type', // 'income' or 'expense'
        'item_name',
        'quantity',
        'price',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Helper to calculate total line item value
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    // Accessor: Create 'amount' as an alias for 'price' for better semantics in views
    public function getAmountAttribute()
    {
        return $this->price;
    }
}
