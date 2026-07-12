<?php

// Declare the namespace for the current file, indicating its location within the application's Traits.

namespace App\Traits;

// Import the UploadedFile class for type hinting file uploads.
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
// Import the Cloudinary facade for interacting with the Cloudinary service.
use Illuminate\Http\UploadedFile;
// Import the Log facade for logging messages and errors.
use Illuminate\Support\Facades\Log;

/**
 * Trait CloudinaryUpload
 */
trait CloudinaryUpload
{
    /**
     * The "booting" method of the trait. This method is automatically called by Eloquent
     * when the trait is used on a model. It registers event listeners for model lifecycle hooks.
     *
     * @return void
     */
    protected static function bootCloudinaryUpload()
    {
        // Register a 'saving' event listener on the model that uses this trait.
        // This closure will execute before the model is saved (either created or updated),
        // allowing for interception and handling of file uploads.
        static::saving(function ($model) {
            // Iterate over the file attributes defined by the model (e.g., 'payment_proof', 'poster_image').
            foreach ($model->getFileAttributes() as $attribute) {
                // Check if the current attribute's value is an instance of UploadedFile,
                // indicating that a new file has been provided for upload.
                if ($model->{$attribute} instanceof UploadedFile) {
                    // Get the UploadedFile instance.
                    $file = $model->{$attribute};
                    // Determine the folder name on Cloudinary. Default is model's class name (lowercase).
                    $folder = strtolower(class_basename($model));

                    // Special case: If the model is an Artwork, always store in the 'artworks' folder.
                    // This allows for custom folder logic based on model type.
                    if ($model instanceof \App\Models\Artwork) {
                        $folder = 'artworks';
                    }
                    // The column that stores the Cloudinary public ID differs
                    // per table (image_public_id, poster_image_public_id,
                    // payment_proof_public_id, ...), so ask the model.
                    $publicIdColumn = $model->getPublicIdColumn();

                    // Check if the model already exists (meaning it's an update operation)
                    // and if it has a public ID associated with a previously uploaded image.
                    if ($model->exists && $model->{$publicIdColumn}) {
                        Log::info('Attempting to delete old Cloudinary image. Model: '.class_basename($model).", Old Public ID: {$model->{$publicIdColumn}}");
                        try {
                            // Attempt to destroy (delete) the old image from Cloudinary using its public ID.
                            Cloudinary::destroy($model->{$publicIdColumn});
                            Log::info("Successfully deleted old Cloudinary image: {$model->{$publicIdColumn}}");
                        } catch (\Exception $e) {
                            // Log a warning if deletion fails, but do not prevent the save operation.
                            Log::warning("Failed to delete old Cloudinary image with public ID: {$model->{$publicIdColumn}}. Error: {$e->getMessage()}");
                        }
                    }

                    // Upload the new file to Cloudinary and get the result (secure URL and public ID).
                    $uploadResult = $model->uploadToCloudinary($file, $folder);

                    // If the upload was successful.
                    if ($uploadResult) {
                        // Update the model's file attribute (e.g., 'payment_proof') with the secure URL from Cloudinary.
                        $model->{$attribute} = $uploadResult['secure_url'];
                        // Store the public ID of the newly uploaded image. This is crucial for future updates/deletions.
                        $model->{$publicIdColumn} = $uploadResult['public_id'];
                        Log::info('Cloudinary upload successful. Model: '.class_basename($model).", New Secure URL: {$uploadResult['secure_url']}, New Public ID: {$uploadResult['public_id']}");
                    } else {
                        // If the upload failed.
                        if ($model->exists) {
                            // If it's an update, retain the old image reference if the new upload failed.
                            Log::error("Cloudinary upload failed for {$attribute} on model ".class_basename($model).'. Retaining old image reference.');
                            // The model's existing attribute value remains unchanged.
                        } else {
                            // If it's a new record (create operation), set the image path and public ID to null
                            // since the upload failed and there's no old image to fall back on.
                            $model->{$attribute} = null;
                            $model->{$publicIdColumn} = null;
                            Log::error("Cloudinary upload failed for {$attribute} on model ".class_basename($model).'. Setting to null for new record.');
                        }
                    }
                }
            }
        });
    }

    /**
     * Abstract method that models using this trait must implement.
     * It should return an array of attribute names that represent files to be uploaded to Cloudinary.
     *
     * @return array<string> An array of model attribute names that hold file data.
     */
    abstract protected function getFileAttributes(): array;

    /**
     * The column that stores the Cloudinary public ID for this model.
     * Override in models whose table names the column differently
     * (e.g. poster_image_public_id, payment_proof_public_id).
     */
    protected function getPublicIdColumn(): string
    {
        return 'image_public_id';
    }

    /**
     * Upload an image to Cloudinary.
     * This method centralizes the Cloudinary upload logic, applying default transformations
     * and handling the API interaction.
     *
     * @param  UploadedFile  $file  The file to upload.
     * @param  string|null  $folder  The target folder on Cloudinary (e.g., 'events', 'artworks').
     * @param  array  $options  Additional transformation or upload options to merge with defaults.
     * @return array|null An array containing 'secure_url' and 'public_id' on success, or null on failure.
     */
    public function uploadToCloudinary(UploadedFile $file, ?string $folder = null, array $options = [])
    {
        try {
            // Define default upload options including common transformations for image optimization.
            $defaultOptions = [
                'folder' => $folder, // Set the target folder on Cloudinary.
                'transformation' => [
                    'width' => 500,           // Resize image to a maximum width of 500 pixels.
                    'crop' => 'limit',        // Crop method to ensure image fits within dimensions without stretching.
                    'quality' => 'auto',      // Optimize image quality automatically.
                    'fetch_format' => 'auto',  // Deliver image in the most optimal format (e.g., WebP).
                ],
            ];

            // Recursively merge default options with any provided custom options, allowing overrides.
            $uploadOptions = array_merge_recursive($defaultOptions, $options);

            // Perform the actual upload to Cloudinary using the file's real path and the defined options.
            $uploadResult = Cloudinary::upload($file->getRealPath(), $uploadOptions);

            // Return the secure URL and public ID from the Cloudinary upload result.
            return [
                'secure_url' => $uploadResult->getSecurePath(), // Get the HTTPS URL of the uploaded image.
                'public_id' => $uploadResult->getPublicId(),    // Get the unique public identifier for the image.
            ];
        } catch (\Exception $e) {
            // Catch any exceptions that occur during the Cloudinary upload process (e.g., API errors, network issues).
            Log::error('Cloudinary upload failed: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return null; // Return null to indicate that the upload operation failed.
        }
    }
}
