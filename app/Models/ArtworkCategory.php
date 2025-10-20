<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtworkCategory extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['name']; // only name can be mass assigned

    // one to many
    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'category_id');
    }
}
