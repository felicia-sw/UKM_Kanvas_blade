<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rundown extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'start_time',
        'end_time',
        'activity',
        'description',
        'person_in_charge',
    ];

    // Important: Automatically convert these columns to Carbon date objects
    // This allows you to use ->format('H:i') in your Blade views
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}