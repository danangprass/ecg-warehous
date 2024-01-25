<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductLink extends Model
{
    use HasFactory;

    protected $table = 'product_links';
    protected $fillable = [
        'owner_id',
        'link',
        'amount',
    ];

    public function owner() : BelongsTo {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function transaction() : HasOne {
        return $this->hasOne(Transaction::class, 'product_link_id');
    }
}
