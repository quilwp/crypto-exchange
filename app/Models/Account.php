<?php

namespace App\Models;

use App\Entities\Account as AccountEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property Collection<Transaction> $transactions
 */
class Account extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        //TODO: create custom relation. This case won`t work with eager loading :(
        return $this->hasMany(Transaction::class, 'sender_id')
                    ->orWhere('recipient_id', $this->user_id);
    }

    /**
     * @return int
     */
    public function getIdAttribute(): int
    {
        return $this->attributes['user_id'];
    }

    /**
     * @return AccountEntity
     */
    public function toEntity(): AccountEntity
    {
        return new AccountEntity($this->id);
    }
}
