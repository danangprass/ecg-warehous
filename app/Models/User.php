<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bank_account',
        'email',
        'phonenumber',
        'password',
        'last_login',
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
        'password' => 'hashed',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(ProductLink::class, 'owner_id');
    }
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'owner_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->using(UserHasProduct::class);
    }
    // public function products(): BelongsToMany
    // {
    //     return $this->belongsToMany(Product::class, 'user_has_product', 'user_id', 'product_id');
    // }

    public function pivot(): HasMany{
        return $this->hasMany(UserHasProduct::class, 'user_id');
    }
}
