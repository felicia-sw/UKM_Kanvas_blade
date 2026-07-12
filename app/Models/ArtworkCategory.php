<?php

// Declare the namespace for the current file, indicating its location within the application's Models.
namespace App\Models;

// Import the HasFactory trait, which provides a convenient way to create model factories.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import the base Model class from Laravel's Eloquent ORM.
use Illuminate\Database\Eloquent\Model;

// Declare the ArtworkCategory class, extending Laravel's base Model class.
class ArtworkCategory extends Model
{
    // Use the HasFactory trait within this model.
    use HasFactory;
    
    // REMOVED: public $timestamps = false; // This comment indicates that timestamps were previously disabled but are now implicitly enabled (Laravel default).
    
    // Define the fillable properties, which can be mass-assigned.
    protected $fillable = ['name', 'description']; // The 'name' of the category and its 'description'.

    // Define a one-to-many relationship with the Artwork model.
    public function artworks()
    {
        // An artwork category can have many artworks, linked by 'category_id'.
        return $this->hasMany(Artwork::class, 'category_id');
    }
}