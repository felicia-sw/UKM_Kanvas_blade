<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtworkCategory extends Model
{
    use HasFactory;
    
    // REMOVED: public $timestamps = false;
    
    protected $fillable = ['name', 'description'];

    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'category_id');
    }
}