<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =======================================
    // 1. AUTH & PROFILE
    // =======================================

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // =======================================
    // 2. NEW FEATURE RELATIONSHIPS
    // =======================================

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function shoppingCart()
    {
        return $this->hasOne(ShoppingCart::class);
    }

    public function merchandiseOrders()
    {
        return $this->hasMany(MerchandiseOrder::class);
    }

    public function duesPayments()
    {
        return $this->hasMany(DuesPayment::class);
    }

    public function contactSubmissions()
    {
        return $this->hasMany(ContactUs::class);
    }

    public function customNotifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadCustomNotifications()
    {
        return $this->customNotifications()->where('is_read', false);
    }
}
