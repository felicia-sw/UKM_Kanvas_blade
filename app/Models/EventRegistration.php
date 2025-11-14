<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'name',
        'nim',
        'jurusan',
        'asal_universitas',
        'nomor_telp',
        'is_kanvas_member',
        'days_attending',
        'payment_proof',
        'payment_status',
        'amount_paid',
    ];

    protected $casts = [
        'is_kanvas_member' => 'boolean',
        'amount_paid' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
