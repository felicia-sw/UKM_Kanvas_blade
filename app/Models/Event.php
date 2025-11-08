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
        'registration_deadline',
        'price',
        'location',
        'max_participants',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'date',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function documentations()
    {
        return $this->hasMany(Documentation::class, 'event_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now())->orderBy('start_date');
    }
}