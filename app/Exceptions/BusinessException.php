<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    /**
     * Exclusion level
     * @var int
     */
    protected int $level = 1;
}
