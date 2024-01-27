<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public const TYPE = ['body', 'engine', 'extra'];
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'type',
        'amount',
        'price',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function myTransactions(): HasMany
    {
        return $this->hasMany(TransactionDetail::class)->whereRelation('transaction', 'owner_id', Auth::user()->id);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_product', 'product_id', 'user_id');
    }

    public function pivot() : HasMany {
        return $this->hasMany(UserHasProduct::class);
    }

    public function properties() : HasMany {
        return $this->hasMany(UserHasProduct::class)->where('product_id', $this->id);
    }

    public function mine() : HasOne {
        return $this->hasOne(UserHasProduct::class)->where('product_id', $this->id)->where('user_id', Auth::user()->id);
    }

    protected function availableStock(): Attribute{
        return Attribute::make(
            get: fn () => $this->amount - $this->pivot()->sum('amount')
        );
    }

}
