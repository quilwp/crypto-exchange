<?php

namespace App\Models;

use App\Traits\Models\Uuidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @property-read int $sender_id
 * @property-read int $recipient_id
 * @property-read float $amount
 * @method belongsToCurrency(Currency $currency)
 */
class Transaction extends Model
{
    use HasFactory, Uuidable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'currency_id',
        'amount'
    ];

    /**
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'sender_id');
    }

    /**
     * @return BelongsTo
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'recipient_id');
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @param Builder $query
     * @param Currency $currency
     * @return Builder
     */
    public function scopeBelongsToCurrency(Builder $query, Currency $currency): Builder
    {
        return $query->where('currency_id', $currency->id);
    }
}
