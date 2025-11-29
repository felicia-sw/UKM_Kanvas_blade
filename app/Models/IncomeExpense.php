<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'type',
        'item_name',
        'amount',
        'description',
        'transaction_date'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2'
    ];

    // Relationship to Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Scope for income only
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    // Scope for expenses only
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }
}
