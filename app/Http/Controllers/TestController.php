<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\User;
use App\Services\Account\CheckAccountBalanceService;
use Illuminate\Http\Request;

class TestController
{
    public function index(Request $request)
    {
        $user= User::find($request->u);
        $currency = Currency::find($request->c);

        $service = new CheckAccountBalanceService($user->account, $currency);

        dd($service->getBalance()->getCurrency()->getTicker());
    }
}
