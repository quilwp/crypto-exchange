<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $recipient_id
 * @property-read int $payee_id
 * @property-read float $amount
 * @method belongsToCurrency(Currency $currency)
 */
class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'recipient_id',
        'payee_id',
        'currency_id',
        'amount'
    ];

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
    public function payee(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'payee_id');
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @param $query
     * @param Currency $currency
     * @return mixed
     */
    public function scopeBelongsToCurrency($query, Currency $currency)
    {
        return $query->where('currency_id', $currency->id);
    }
}
