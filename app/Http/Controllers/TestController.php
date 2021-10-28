<?php

namespace App\Http\Controllers;

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
        $currency = Currency::find(1);

        $transactionService = new CreateTransactionService(
            User::find(2)->account,
            User::find(1)->account,
            $currency,
            100
        );

        $transactionService->commit();

        $balance1 = (new CheckAccountBalanceService(User::find(1)->account, $currency))->getBalance();
        $balance2 = (new CheckAccountBalanceService(User::find(2)->account, $currency))->getBalance();

        dump('a1: ' . $balance1);
        dump('a2: ' . $balance2);

    }
}
