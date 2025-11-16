<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesPeriod extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'due_date',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    // One DuesPeriod has many payments
    public function payments()
    {
        return $this->hasMany(DuesPayment::class);
    }
}
