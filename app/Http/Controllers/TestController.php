<?php

namespace App\Http\Controllers;

use App\Entities\Account;
use App\Entities\Funds;
use App\Models\Currency;
use App\Models\User;
use App\Services\Account\CheckAccountBalanceService;
use App\Services\Transaction\CreateTransactionService;
use Illuminate\Http\Request;

class TestController
{
    /**
     * @param Request $request
     * @throws \App\Exceptions\Entity\Funds\InvalidAmountException
     * @throws \App\Exceptions\Transaction\AccountBalanceException
     */
    public function index(Request $request)
    {
        $checkAccountValanceService = new CheckAccountBalanceService(
            new Account(4),
            new \App\Entities\Currency(3, 'Bitcoin', 'BTC')
        );

        dd($checkAccountValanceService->getBalance());
    }
}
