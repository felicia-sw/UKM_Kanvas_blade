<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuesPayment extends Model
{
    protected $fillable = [
        'user_id',
        'dues_period_id',
        'payment_status',
        'payment_proof',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // A payment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A payment belongs to a dues period
    public function duesPeriod()
    {
        return $this->belongsTo(DuesPeriod::class);
    }

    // Get the admin who verified this payment
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
