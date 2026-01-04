<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchandiseOrder extends Model
{
    use HasFactory, CloudinaryUpload;

    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_proof',
        'payment_status', // pending, verified, rejected
        'verified_at',
        'pickup_status', // pending, ready, picked_up
    ];

    protected function getFileAttributes(): array
    {
        return ['payment_proof'];
    }

    protected $casts = [
        'grand_total' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(MerchandiseOrderItem::class);
    }
}