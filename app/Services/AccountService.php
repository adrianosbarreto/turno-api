<?php

namespace App\Services;

use App\Repositories\AccountRepository;

class AccountService implements AccountServicesInterface
{
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function createAccountNumber()
    {
        return sprintf('%010d', rand(0, 9999999999));
    }

    public function createAccount($data)
    {
        $account_number = $this->createAccountNumber();

        $data['account_number'] = $account_number;

        return $this->accountRepository->createAccount($data);
    }

    public function getBalance($account_id)
    {
        $account = $this->accountRepository->getAccountByAccountId($account_id);

        return $account->current_balance;
    }

    public function updateBalance($account_id, $amount)
    {
        $account = $this->accountRepository->getAccountByAccountId($account_id);

        $account->current_balance += $amount;
        $account->save();

        return $account;
    }

    public function debitAmount($amount, $account_id)
    {
        $this->updateBalance($account_id, -$amount);
    }

    public function creditAmount($amount, $account_id)
    {
        $this->updateBalance($account_id, $amount);
    }

    public function filterTransactionByMonthYear($account_id, $month, $year)
    {
        return $account_id;
    }

    public function accountByUserId($user_id)
    {

        return $this->accountRepository->accountByUserId($user_id);
    }

}
