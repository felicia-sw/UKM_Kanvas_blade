<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Add this

class Artwork extends Model
{
    use HasFactory, SoftDeletes; // 2. Use this
    
    // REMOVED: public $timestamps = false; (Your migration creates timestamps, so we need them)
    
    protected $fillable = [
        'user_id', // 3. Added this
        'category_id',
        'title',
        'description',
        'image_path',
        'artist_name',
        'created_date'
    ];

    protected $casts = [
        'created_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(ArtworkCategory::class, 'category_id');
    }

    // 4. Added relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}