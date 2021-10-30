<?php

namespace App\Entities;

final class Account
{
    /**
     * @param int $id
     */
    public function __construct(
        private int $id
    ){}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
