<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchandise extends Model
{
    use HasFactory, SoftDeletes, CloudinaryUpload;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image_path',
        'stock',
    ];

    protected function getFileAttributes(): array
    {
        return ['image_path'];
    }

    public function category()
    {
        return $this->belongsTo(MerchandiseCategory::class, 'category_id');
    }
}