<?php

namespace Tests\Concerns;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait FakesCloudinary
{
    /**
     * Stub the Cloudinary facade so uploads made by the CloudinaryUpload
     * trait succeed without hitting the real API.
     */
    protected function fakeCloudinaryUpload(): void
    {
        // CloudinaryEngine::upload() is fluent (returns $this), so the mock
        // must return itself and answer the follow-up getters.
        Cloudinary::shouldReceive('upload')->andReturnSelf();
        Cloudinary::shouldReceive('getSecurePath')->andReturn('https://res.cloudinary.test/fake/upload/proof.jpg');
        Cloudinary::shouldReceive('getPublicId')->andReturn('fake-public-id');
        Cloudinary::shouldReceive('destroy')->andReturnTrue();
    }
}
