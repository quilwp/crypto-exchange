<?php

namespace App\Entities;

final class Currency
{
    /**
     * @param int $id
     * @param string $name
     * @param string $ticker
     */
    public function __construct(
        private int $id,
        private string $name,
        private string $ticker
    )
    {}

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
