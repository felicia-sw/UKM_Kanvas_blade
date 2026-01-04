<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use HasFactory, SoftDeletes, CloudinaryUpload;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image_path', // This is the column for the image
        'artist_name',
        'created_date',
    ];

    protected $casts = [
        'created_date' => 'date',
    ];

    protected function getFileAttributes(): array
    {
        return ['image_path'];
    }

    public function category()
    {
        return $this->belongsTo(ArtworkCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}