<?php

namespace App\Entities;

use Exception;

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
     * @param \App\Models\Currency  $currency
     * @param float $amount
     * @throws Exception
     */
    public function __construct(\App\Models\Currency $currency, float $amount)
    {
        if ($amount < 0) {
            throw new Exception("Negative amount is not possible [$amount]");
        }

        $this->currency = new Currency($currency);
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
