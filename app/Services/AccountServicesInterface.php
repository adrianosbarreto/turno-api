<?php

namespace App\Services;

interface AccountServicesInterface
{
    public function createAccount($data);
    public function updateAccount($data, $id);
    public function deleteAccount($id);
    public function getAccount($id);
    public function getAccountsByUser($user_id);
    public function getAccountsByType($type);

    public function getBalance($account_id);

    public function filterTransactionByMonthYear($account_id, $month, $year);
}
