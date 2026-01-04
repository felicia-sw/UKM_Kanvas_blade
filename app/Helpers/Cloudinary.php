<?php

namespace App\Helpers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

class Cloudinary
{
    public static function upload(UploadedFile $file, $folder)
    {
        return Cloudinary::upload($file->getRealPath(), [
            'folder' => $folder,
        ])->getSecurePath();
    }
}
