<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesPayment extends Model
{
    use CloudinaryUpload, HasFactory;

    protected $fillable = [
        'user_id',
        'dues_period_id',
        'payment_status',
        'payment_proof',
        'verified_by',
        'verified_at',
    ];

    protected function getFileAttributes(): array
    {
        return ['payment_proof'];
    }

    protected function getPublicIdColumn(): string
    {
        return 'payment_proof_public_id';
    }

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
