<?php

namespace App\Services;

interface TransactionServicesInterface
{
    public function addPurchase($data);

    public function addIncome($data);

    public function transactionsByAccountAndTypeOrMonthOrYear($account_id, $type, $month, $year);

}
