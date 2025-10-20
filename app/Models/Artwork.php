<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory; // enables for seeding and testing
    
    public $timestamps = false;
    
    protected $fillable = [ // spy bisa diisi 
        'title',
        'description',
        'image_path',
        'artist_name',
        'category_id',
        'created_date'
    ];

    protected $casts = [ // converts created_date to a Cformat that php can use
        'created_date' => 'date',
    ];

    // many to one
    public function category()
    {
        return $this->belongsTo(ArtworkCategory::class, 'category_id'); // each artwork should belong to one category
    }
}
