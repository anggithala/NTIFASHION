<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'address_one',
        'address_two',
        'provinces_id',
        'regencies_id',
        'zip_code',
        'country',
        'phone_number',
        'avatar',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //public function scopeAdmin($query)
    //{
    //    return $query->where('roles', 'ADMIN');
    //}

    public function scopeOwner($query)
    {
        return $query->where('roles', 'OWNER');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'users_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'users_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }
}
