<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventRegistration extends Model
{
    use HasFactory, CloudinaryUpload;

    protected $fillable = [
        'event_id',
        'user_id',
        'payment_proof',
        'payment_status',
        'amount_paid',
        // Removed: name, nim, jurusan, etc.
    ];

    protected function getFileAttributes(): array
    {
        return ['payment_proof'];
    }

    protected $casts = [
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