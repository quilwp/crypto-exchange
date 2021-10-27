<?php

namespace App\Services\Account;

use App\Models\Account;

final class CheckAccountBalanceService
{
    /**
     * @param Account $account
     */
    public function __construct(
        private Account $account
    ){}

    public function getBalance()
    {

    }
}
