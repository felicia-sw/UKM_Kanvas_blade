<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory; // enables Artwork::factory() for seeding and testing
    
    public $timestamps = false;
    
    protected $fillable = [ // means fields that can be mass-assigned information// populated
        'title',
        'description',
        'image_path',
        'artist_name',
        'category_id',
        'created_date'
    ];

    protected $casts = [ // converts created_date to a Carbon date [carbon adalah library]
        'created_date' => 'date',
    ];

    // Many-to-One: Each artwork belongs to one category
    public function category()
    {
        return $this->belongsTo(ArtworkCategory::class, 'category_id'); // each artwork should belong to one category
    }
}
