<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'jurusan',
        'asal_universitas',
        'no_telp',
    ];

    /**
     * Relationship: A Profile belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}