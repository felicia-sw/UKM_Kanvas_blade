<?php

namespace App\Models;

use App\Traits\CloudinaryUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentation extends Model
{
    use CloudinaryUpload, HasFactory, SoftDeletes;

    protected $table = 'documentations';

    protected $fillable = [
        'event_id',
        'title',
        'file_type',
        'caption',
        'file_path',
    ];

    protected function getFileAttributes(): array
    {
        return ['file_path'];
    }

    protected function getPublicIdColumn(): string
    {
        return 'file_public_id';
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
