<?php

namespace App\Models;

use App\Entities\Currency as CurrencyEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property string $ticker
 */
class Currency extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'ticker'
    ];

    /**
     * @return CurrencyEntity
     */
    public function toEntity(): CurrencyEntity
    {
        return new CurrencyEntity(
            $this->id,
            $this->name,
            $this->ticker
        );
    }
}
