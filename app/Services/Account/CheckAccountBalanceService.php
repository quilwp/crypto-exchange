<?php

namespace App\Services\Account;

use DB;
use App\Entities\Account;
use App\Entities\Currency;
use Illuminate\Database\Query\Builder;
use App\Exceptions\Account\Balance\InvalidBalanceException;


final class CheckAccountBalanceService
{
    /**
     * @var Builder
     */
    protected Builder $transactionQuery;

    /**
     * @param Account $account
     * @param Currency $currency
     */
    public function __construct(
        private Account $account,
        private Currency $currency
    ){
        $this->transactionQuery = $this->createTransactionQuery();
    }

    /**
     * @return Builder
     */
    private function createTransactionQuery(): Builder
    {
        return DB::table('transactions')
            ->selectRaw('coalesce(sum(case when recipient_id = ? then amount else 0 end), 0) as income', [$this->account->getId()])
            ->selectRaw('coalesce(sum(case when sender_id = ? then amount else 0 end), 0) as outcome', [$this->account->getId()])
            ->selectRaw('count(1) as count')
            ->where(function ($query) {
                $query->where('sender_id', $this->account->getId());
                $query->orWhere('recipient_id', $this->account->getId());
            })
            ->where('currency_id', $this->currency->getId());
    }

    /**
     * @return float
     * @throws InvalidBalanceException
     */
    public function getBalance(): float
    {
        $result = $this->transactionQuery->first();

        if (is_numeric($result->income) && is_numeric($result->outcome)) {
            return bcsub($result->income, $result->outcome);
        }

        throw new InvalidBalanceException('Invalid balance!');
    }
}
