<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserHasProduct extends Model
{
    use HasFactory;

    protected $table = 'user_has_product';
    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }
    // public function amount(){
    //     return $this->belongsTo(User::class,'amount');
    // }
}
