<?php

namespace App\Services\Account;

use DB;
use Decimal\Decimal;
use Exception;
use App\Entities\Funds;
use App\Models\Account;
use App\Models\Currency;
use Illuminate\Database\Query\Builder;

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
            ->selectRaw('sum(case when payee_id = ? then amount else 0 end) as income', [$this->account->id])
            ->selectRaw('sum(case when recipient_id = ? then amount else 0 end) as outcome', [$this->account->id])
            ->where(function ($query) {
                $query->where('payee_id', $this->account->id);
                $query->orWhere('recipient_id', $this->account->id);
            })
            ->where('currency_id', $this->currency->id);
    }

    /**
     * @return Funds
     * @throws Exception
     */
    public function getBalance(): Funds
    {
        $result = $this->transactionQuery->first();

        if (is_numeric($result->income) && is_numeric($result->outcome)) {
            return new Funds($this->currency, bcsub($result->income, $result->outcome));
        }

        throw new Exception('fail');
    }
}
