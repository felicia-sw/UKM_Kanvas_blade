<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        // NOTE: 'is_admin' is REMOVED here. If you still see it, you are in the old file.
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
    // 1. NEW CORE RELATIONSHIPS (These are missing in your file!)
    // =======================================

    // Relationship: A User has ONE Profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Relationship: A User has MANY Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // =======================================
    // 2. THE MISSING FUNCTION (This Fixes Your Error)
    // =======================================
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    // =======================================
    // 3. EXISTING DUES RELATIONSHIPS
    // =======================================

    public function duesPayments()
    {
        return $this->hasMany(DuesPayment::class);
    }

    public function verifiedDuesPayments()
    {
        return $this->hasMany(DuesPayment::class, 'verified_by');
    }
}