<?php
// Declare the namespace for the current file, indicating its location within the application's structure.
namespace App\Models;

// Import the CloudinaryUpload trait, which handles logic for uploading files to Cloudinary.
use App\Traits\CloudinaryUpload;
// Import the HasFactory trait, which provides a convenient way to create model factories for testing and seeding.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import the base Model class from Laravel's Eloquent ORM.
use Illuminate\Database\Eloquent\Model;
// Import the SoftDeletes trait, which enables "soft deleting" records instead of permanent deletion.
use Illuminate\Database\Eloquent\SoftDeletes;

// Declare the Artwork class, extending Laravel's base Model class.
class Artwork extends Model
{
    // Use the HasFactory, SoftDeletes, and CloudinaryUpload traits within this model.
    use HasFactory, SoftDeletes, CloudinaryUpload;

    // Define the fillable properties, which can be mass-assigned using Eloquent's create or update methods.
    protected $fillable = [
        'user_id', // The ID of the user who created the artwork.
        'category_id', // The ID of the category the artwork belongs to.
        'title', // The title of the artwork.
        'description', // A description of the artwork.
        'image_path', // The URL or path to the artwork's image (this will store the Cloudinary secure URL).
        'image_public_id', // The public ID of the image on Cloudinary, used for management (e.g., deletion).
        'artist_name', // The name of the artist.
        'created_date', // The date the artwork was created.
    ];

    // Define type casting for model attributes.
    protected $casts = [
        'created_date' => 'date', // Casts the 'created_date' attribute to a Carbon date instance.
    ];

    // Define a protected method to return the attributes that hold file instances for Cloudinary upload.
    protected function getFileAttributes(): array
    {
        // Specify that 'image_path' is the attribute that contains the file to be uploaded.
        return ['image_path'];
    }

    // Define a one-to-many inverse relationship with the ArtworkCategory model.
    public function category()
    {
        // An artwork belongs to one category, linked by 'category_id'.
        return $this->belongsTo(ArtworkCategory::class, 'category_id');
    }

    // Define a one-to-many inverse relationship with the User model.
    public function user()
    {
        // An artwork belongs to one user.
        return $this->belongsTo(User::class);
    }
}