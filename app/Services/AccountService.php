<?php

namespace App\Services;

class AccountService implements AccountServicesInterface
{
    public function createAccount($data)
    {
        return $data;
    }

    public function updateAccount($data, $id)
    {
        return $data;
    }

    public function deleteAccount($id)
    {
        return $id;
    }

    public function getAccount($id)
    {
        return $id;
    }

    public function getAccountsByUser($user_id)
    {
        return $user_id;
    }

    public function getAccountsByType($type)
    {
        return $type;
    }

    public function getBalance($account_id)
    {
        return $account_id;
    }

    public function filterTransactionByMonthYear($account_id, $month, $year)
    {
        return $account_id;
    }
}
