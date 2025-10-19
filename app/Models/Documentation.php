<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'title',
        'image_path',
        'event_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Many-to-One: Each documentation belongs to one event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}