<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;
    
    // Explicitly state table name 
    protected $table = 'documentations'; 

    /**
     * The attributes that are mass assignable.
     * Only include the columns you want to allow in create/update operations.
     */
    protected $fillable = [
        'event_id',
        'title',
          'file_path',
           ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        // REMOVED: 'is_featured' casting since we are not using it
    ];

    /**
     * Get the event that owns the documentation.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}