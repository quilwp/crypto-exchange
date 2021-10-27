<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Account\CheckAccountBalanceService;

class TestController
{
    public function index()
    {
        $account = User::find(1)->account;

        $service = new CheckAccountBalanceService($account);

        dd($service->getBalance());
    }
}
