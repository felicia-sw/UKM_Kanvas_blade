<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EventRegistration
 *
 * @package App\Models
 *
 * Represents a user's registration for a specific event.
 * Handles the storage of registration details, payment proof, and payment status.
 */
class EventRegistration extends Model
{
    use HasFactory, CloudinaryUpload; // Utilizes CloudinaryUpload trait for handling file uploads (e.g., payment proof).

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',         // The ID of the event the user is registering for.
        'user_id',          // The ID of the user who registered.
        'payment_proof',    // Stores the public ID of the payment proof image uploaded to Cloudinary.
        'payment_status',   // Current status of the payment (e.g., 'pending', 'verified', 'rejected').
        'amount_paid',      // The amount paid for the event registration.
        // Removed: name, nim, jurusan, etc. (These details are typically stored in the User's Profile model)
    ];

    /**
     * Defines the attributes that should be treated as files for Cloudinary uploads.
     * This method is part of the CloudinaryUpload trait.
     *
     * @return array
     */
    protected function getFileAttributes(): array
    {
        return ['payment_proof'];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount_paid' => 'decimal:2',
    ];

    /**
     * Get the event that the registration belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user that owns the registration.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}