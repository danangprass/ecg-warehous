<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;
    public const TYPE = ['repair', 'modif', 'reimburse', 'bonus'];
    protected $table = 'transactions';
    protected $fillable = [
        'date',
        'type',
        'owner_id',
        "product_link_id",
        'bonus',
        'reimbursement',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function link(): BelongsTo
    {
        return $this->belongsTo(ProductLink::class, 'product_link_id');
    }

    /**
     * Get the user's first name.
     */
    protected function fee(): Attribute
    {
        return Attribute::make(
            get: fn () =>
            match ($this->type) {
                'repair' => round($this->details->sum('total') +  $this->bonus),
                'modif' => round(($this->link->amount * 0.086) + $this->bonus),
                default => $this->bonus,
            }
        );
    }

    /**
     * Get the user's first name.
     */
    protected function reimburse(): Attribute
    {
        return Attribute::make(
            get: fn () =>
            match ($this->type) {
                'modif' =>  round(($this->link->amount * 0.86) + ($this->reimbursement ?? 0)),
                default => ($this->reimbursement ?? 0),
            }
        );
    }

}
