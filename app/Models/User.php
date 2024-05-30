<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }
        return asset('images/default-avatar.png'); // Change this to your default image path
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getDefaultAddressAttribute()
    {
        return $this->addresses?->first();
    }
    
    public function usersCoolPosts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function updatePassword(string $newPassword)
    {
        $this->password = Hash::make($newPassword);
        $this->save();
    }
}
