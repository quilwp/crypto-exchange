<?php

namespace App\Services\Transaction;

use App\Entities\Account;
use App\Entities\Funds;
use App\Models\Transaction;
use App\Services\Account\CheckAccountBalanceService;
use App\Exceptions\Transaction\AccountBalanceException;
use App\Exceptions\Account\Balance\InvalidBalanceException;

final class CreateTransactionService
{
    /**
     * @param Account $sender
     * @param Account $recipient
     * @param Funds $funds
     */
    public function __construct(
        private Account $sender,
        private Account $recipient,
        private Funds $funds
    ){}

    /**
     * @throws AccountBalanceException
     * @throws InvalidBalanceException
     */
    public function commit(): void
    {
        $balance = (new CheckAccountBalanceService($this->sender, $this->funds->getCurrency()))->getBalance();

        if ($this->funds->getAmount() <= $balance) {
            Transaction::create([
                'sender_id' => $this->sender->getId(),
                'recipient_id' => $this->recipient->getId(),
                'currency_id' => $this->funds->getCurrency()->getId(),
                'amount' => $this->funds->getAmount(),
            ]);
        } else {
            throw new AccountBalanceException('Insufficient funds on the account', 422);
        }
    }
}
