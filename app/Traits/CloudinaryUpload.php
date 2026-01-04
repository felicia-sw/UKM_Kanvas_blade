<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str;

trait CloudinaryUpload
{
    public static function bootCloudinaryUpload()
    {
        static::saving(function (Model $model) {
            foreach ($model->getFileAttributes() as $attribute) {
                if ($model->getAttribute($attribute) instanceof UploadedFile) {
                    if ($model->exists && $model->getOriginal($attribute)) {
                        $model->deleteImage($model->getOriginal($attribute));
                    }

                    $uploadedFile = $model->getAttribute($attribute);

                    // TEMPORARY FIX for SSL certificate issue on Windows
                    // TODO: Configure CA bundle in php.ini for production
                    $uploadedFileUrl = Cloudinary::upload($uploadedFile->getRealPath(), [
                        'folder' => $model->getCloudinaryFolder(),
                        'context' => ['ssl_verify_peer' => false], // Disable SSL verification for development
                    ])->getSecurePath();

                    $model->setAttribute($attribute, $uploadedFileUrl);
                }
            }
        });

        static::deleting(function (Model $model) {
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                return;
            }
            foreach ($model->getFileAttributes() as $attribute) {
                $model->deleteImage($model->getAttribute($attribute));
            }
        });
    }

    protected function deleteImage($imageUrl)
    {
        if (!$imageUrl) {
            return;
        }
        $publicId = $this->getPublicIdFromUrl($imageUrl);
        if ($publicId) {
            Cloudinary::destroy($publicId);
        }
    }

    protected function getPublicIdFromUrl($imageUrl)
    {
        if (preg_match('/\/upload\/(?:v\d+\/)?(.+?)(?:\.\w+)?$/', $imageUrl, $matches)) {
            return $matches[1];
        }
        return null;
    }

    protected function getFileAttributes(): array
    {
        return ['image'];
    }

    protected function getCloudinaryFolder(): string
    {
        return Str::lower(Str::plural(class_basename($this)));
    }
}
