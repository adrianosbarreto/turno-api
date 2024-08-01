<?php

namespace App\Services;

interface AccountServicesInterface
{
    public function createAccount($data);

    public function getBalance($account_id);

    public function filterTransactionByMonthYear($account_id, $month, $year);

    public function updateBalance($account_id, $amount);

    public function accountByUserId($user_id);
}
