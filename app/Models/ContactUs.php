<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    // Because table name is singular/irregular, we specify it
    protected $table = 'contact_us';

    protected $fillable = [
        'full_name',
        'email',
        'tele_number',
        'subject',
        'message',
        'user_id', // Optional, can be null
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}