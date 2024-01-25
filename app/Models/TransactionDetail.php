<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $fillable = [
        'product_id',
        'link',
        'amount',
    ];

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }
    
    public function transaction() : BelongsTo {
        return $this->belongsTo(Transaction::class);
    }
}
