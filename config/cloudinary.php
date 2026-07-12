<?php

/*
 * This file is part of the Laravel Cloudinary package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Return an array representing the Cloudinary configuration settings.
return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration - Notification URL
    |--------------------------------------------------------------------------
    |
    | An HTTP or HTTPS URL to notify your application (a webhook) when the process of uploads, deletes, and any API
    | that accepts notification_url has completed.
    |
    |
    */
    // Define the notification URL for Cloudinary webhooks, retrieved from the environment variables.
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration - Cloud URL
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Cloudinary settings. Cloudinary is a cloud hosted
    | media management service for all file uploads, storage, delivery and transformation needs.
    |
    |
    */
    // Define the main Cloudinary URL, typically containing credentials, retrieved from environment variables.
    'cloud_url' => env('CLOUDINARY_URL'),

    /**
     * Upload Preset From Cloudinary Dashboard
     */
    // Define the upload preset to be used for Cloudinary uploads, retrieved from environment variables.
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),

    /**
     * Route to get cloud_image_url from Blade Upload Widget
     */
    // Define a specific route for handling Cloudinary image uploads, retrieved from environment variables.
    'upload_route' => env('CLOUDINARY_UPLOAD_ROUTE'),

    /**
     * Controller action to get cloud_image_url from Blade Upload Widget
     */
    // Define a specific controller action for handling Cloudinary image uploads, retrieved from environment variables.
    'upload_action' => env('CLOUDINARY_UPLOAD_ACTION'),
];
