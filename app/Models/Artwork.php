<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'artist_name',
        'category_id',
        'created_date'
    ];

    protected $casts = [
        'created_date' => 'date',
    ];

    // Many-to-One: Each artwork belongs to one category
    public function category()
    {
        return $this->belongsTo(ArtworkCategory::class, 'category_id');
    }
}
