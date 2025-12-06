<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add SoftDeletes

class Merchandise extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', // Add category_id
        'name',
        'description',
        'price',
        'image_path',
        'stock',       // Add stock
    ];

    public function category()
    {
        return $this->belongsTo(MerchandiseCategory::class);
    }
}