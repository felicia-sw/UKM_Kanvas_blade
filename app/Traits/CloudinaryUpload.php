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
                    
                    // Determine if file is a video or image
                    $mimeType = $uploadedFile->getMimeType();
                    $isVideo = Str::startsWith($mimeType, 'video/');
                    
                    // Upload to Cloudinary with proper folder organization
                    if ($isVideo) {
                        $uploadedFileUrl = Cloudinary::uploadVideo($uploadedFile->getRealPath(), [
                            'folder' => $model->getCloudinaryFolder(),
                            'resource_type' => 'video',
                        ])->getSecurePath();
                    } else {
                        $uploadedFileUrl = Cloudinary::upload($uploadedFile->getRealPath(), [
                            'folder' => $model->getCloudinaryFolder(),
                        ])->getSecurePath();
                    }

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
            // Try to determine if it's a video based on URL or file extension
            $isVideo = Str::contains($imageUrl, ['/video/', '.mp4', '.mov', '.avi']);
            
            if ($isVideo) {
                Cloudinary::destroy($publicId, ['resource_type' => 'video']);
            } else {
                Cloudinary::destroy($publicId);
            }
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
