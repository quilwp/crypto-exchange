<?php

namespace App\Exceptions\Account\Balance;

use App\Exceptions\BusinessException;

class InvalidBalanceException extends BusinessException
{
    protected int $level = 6;
}
