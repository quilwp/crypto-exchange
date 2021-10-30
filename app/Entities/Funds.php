<?php

namespace App\Entities;

use App\Exceptions\Entity\Funds\InvalidAmountException;


final class Funds
{
    /**
     * @var Currency
     */
    private Currency $currency;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @param Currency $currency
     * @param float $amount
     * @throws InvalidAmountException
     */
    public function __construct(Currency $currency, float $amount)
    {
        if ($amount <= 0) {
            throw new InvalidAmountException("Negative and zero amount is not possible!");
        }

        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
