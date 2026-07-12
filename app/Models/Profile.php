<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 */
class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',          // The ID of the user this profile belongs to.
        'nim',              // Student identification number.
        'jurusan',          // Major/Department.
        'asal_universitas', // University of origin.
        'no_telp',          // Phone number, crucial for sending WhatsApp notifications.
    ];

    /**
     * Relationship: A Profile belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
