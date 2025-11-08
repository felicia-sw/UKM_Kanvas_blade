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
     * 💡 FIX 2: Added file_path (renamed from image_path), file_type, caption, is_featured.
     */
    protected $fillable = [
        'event_id',
        'title',
        'file_path', 
        // 'file_type', 
        'caption',
        'is_featured',
    ];

    /**
     * The attributes that should be cast to native types.
     * 💡 FIX 3: Added casting for the new boolean field.
     */
    protected $casts = [
        'is_featured' => 'boolean',
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