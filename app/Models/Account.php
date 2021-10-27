<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(Transaction::class, 'recipient_id')
                    ->orWhere('payee_id', $this->user_id);
    }
}
