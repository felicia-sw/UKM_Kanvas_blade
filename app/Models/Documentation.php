<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;
    
    protected $table = 'documentations'; 

    protected $fillable = [
        'event_id',
        'title',
        'file_type', // New
        'caption',   // New
        'file_path', // Renamed from image_path
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}