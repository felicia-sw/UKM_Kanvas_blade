<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait CloudinaryUpload
{
    /**
     * Upload an image to Cloudinary.
     * the use of this is to not repeat urself 
     * @param UploadedFile $file The file to upload.
     * @param string|null $folder The folder to store the image in.
     * @param array $transformation Transformation options.
     * @return string|null The secure URL of the uploaded file.
     */
    public function uploadToCloudinary(UploadedFile $file, ?string $folder = null, array $options = []): ?string
    {
        try {
            $defaultOptions = [
                'folder' => $folder,
                'transformation' => [
                    'width' => 500,
                    'crop' => 'limit',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ];

            // Merge default options with provided options
            $uploadOptions = array_merge_recursive($defaultOptions, $options);

            return Cloudinary::upload($file->getRealPath(), $uploadOptions)->getSecurePath();
        } catch (\Exception $e) {
            // Optionally log the error
            // Log::error('Cloudinary upload failed: ' . $e->getMessage());
            return null;
        }
    }
}
