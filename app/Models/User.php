<?php

// Declare the namespace for the current file, indicating its location within the application's Models.
namespace App\Models;

// Import the HasFactory trait, which provides a convenient way to create model factories.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import the Authenticatable class, which provides Laravel's authentication features.
use Illuminate\Foundation\Auth\User as Authenticatable;
// Import the Notifiable trait, which enables sending notifications via various channels.
use Illuminate\Notifications\Notifiable;
// Import the SoftDeletes trait, which enables "soft deleting" records instead of permanent deletion.
use Illuminate\Database\Eloquent\SoftDeletes;

// Declare the User class, extending Laravel's Authenticatable class.
class User extends Authenticatable
{
    // Use the HasFactory, Notifiable, and SoftDeletes traits within this model.
    use HasFactory, Notifiable, SoftDeletes;

    // Define the fillable properties, which can be mass-assigned using Eloquent's create or update methods.
    protected $fillable = [
        'name', // The user's name.
        'email', // The user's email address.
        'password', // The user's hashed password.
    ];

    // Define the attributes that should be hidden for arrays.
    // These attributes will not be serialized when the model is converted to an array or JSON.
    protected $hidden = [
        'password', // Hide the password attribute for security.
        'remember_token', // Hide the remember token attribute.
    ];

    // Define the type casts for model attributes.
    // This method is used to specify how certain attributes should be cast when retrieved from the database.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Cast 'email_verified_at' to a Carbon datetime instance.
            'password' => 'hashed', // Ensure the 'password' is automatically hashed when set.
        ];
    }

    // =======================================
    // 1. AUTH & PROFILE
    // =======================================

    // Define a one-to-one relationship with the Profile model.
    public function profile()
    {
        // A user has one profile. This profile typically stores additional user information,
        // including the 'no_telp' (phone number) which is used for sending WhatsApp notifications.
        return $this->hasOne(Profile::class);
    }

    // Define a many-to-many relationship with the Role model.
    public function roles()
    {
        // A user can have many roles, connected via the 'role_user' pivot table.
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Helper method to check if the user has a specific role.
    public function hasRole($roleName)
    {
        // Query the roles relationship to see if a role with the given name exists for this user.
        return $this->roles()->where('name', $roleName)->exists();
    }

    // =======================================
    // 2. NEW FEATURE RELATIONSHIPS
    // =======================================

    // Define a one-to-many relationship with the Artwork model.
    public function artworks()
    {
        // A user can have many artworks.
        return $this->hasMany(Artwork::class);
    }

    // Define a one-to-many relationship with the EventRegistration model.
    public function eventRegistrations()
    {
        // A user can have many event registrations. This relationship links a user
        // to all the events they have registered for, and is used to retrieve
        // specific registration details, including payment status and proof.
        return $this->hasMany(EventRegistration::class);
    }

    // Define a one-to-one relationship with the ShoppingCart model.
    public function shoppingCart()
    {
        // A user has one shopping cart.
        return $this->hasOne(ShoppingCart::class);
    }

    // Define a one-to-many relationship with the MerchandiseOrder model.
    public function merchandiseOrders()
    {
        // A user can have many merchandise orders.
        return $this->hasMany(MerchandiseOrder::class);
    }

    // Define a one-to-many relationship with the DuesPayment model.
    public function duesPayments()
    {
        // A user can have many dues payments.
        return $this->hasMany(DuesPayment::class);
    }

    // Define a one-to-many relationship with the Notification model (custom notifications).
    public function customNotifications()
    {
        // A user can have many custom notifications.
        return $this->hasMany(Notification::class);
    }

    // Define a relationship to retrieve only unread custom notifications.
    public function unreadCustomNotifications()
    {
        // Filter custom notifications where 'is_read' is false.
        return $this->customNotifications()->where('is_read', false);
    }
}
