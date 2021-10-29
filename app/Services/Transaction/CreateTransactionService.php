<?php

namespace App\Services\Transaction;

use App\Entities\Funds;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use App\Services\Account\CheckAccountBalanceService;
use App\Exceptions\Transaction\AccountBalanceException;
use App\Exceptions\Entity\Funds\InvalidAmountException;
use App\Exceptions\Account\Balance\InvalidBalanceException;

final class CreateTransactionService
{
    /**
     * @var Funds
     */
    private Funds $funds;

    /**
     * @param Account $sender
     * @param Account $recipient
     * @param Currency $currency
     * @param float $amount
     * @throws InvalidAmountException
     */
    public function __construct(
        private Account $sender,
        private Account $recipient,
        private Currency $currency,
        float $amount
    ){

        $this->funds = new Funds($currency, $amount);
    }

    /**
     * @throws AccountBalanceException
     * @throws InvalidBalanceException
     */
    public function commit(): void
    {
        $balance = (new CheckAccountBalanceService($this->sender, $this->currency))->getBalance();

        if ($this->funds->getAmount() <= $balance) {
            Transaction::create([
                'sender_id' => $this->sender->id,
                'recipient_id' => $this->recipient->id,
                'currency_id' => $this->currency->id,
                'amount' => $this->funds->getAmount(),
            ]);
        } else {
            throw new AccountBalanceException('Insufficient funds on the account', 422);
        }
    }
}
