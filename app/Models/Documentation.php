<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;
    
    // 💡 FIX 1: Allow Laravel to manage timestamps, matching the database migration
    // We are deleting the custom timestamp logic to use the default settings
    // Since your migration has $table->timestamps(), leave $timestamps to default (true)
    // We also explicitly state the table name due to the pluralization confusion in your down() method
    protected $table = 'documentations'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'event_id',
        'title',
        'image_path',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        // 'is_featured' => 'boolean', // Column doesn't exist yet
    ];

    /**
     * Get the event that owns the documentation.
     */
    public function event()
    {
        // We can safely remove the second argument as Laravel defaults to 'event_id'
        return $this->belongsTo(Event::class);
    }
}