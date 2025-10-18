<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'poster_image',
        'start_date',
        'end_date',
        'location',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // One-to-Many: One event has many documentation photos
    public function documentation()
    {
        return $this->hasMany(Documentation::class, 'event_id');
    }
    
    // Scope for active events
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // Scope for upcoming events
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now())->orderBy('start_date');
    }
}