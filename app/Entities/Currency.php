<?php

namespace App\Entities;

final class Currency
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $ticker;

    /**
     * @param \App\Models\Currency $currency
     */
    public function __construct(\App\Models\Currency $currency)
    {
        $this->id = $currency->id;
        $this->name = $currency->name;
        $this->ticker = $currency->ticker;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTicker(): string
    {
        return $this->ticker;
    }
}
