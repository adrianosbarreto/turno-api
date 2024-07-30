<?php

namespace App\Services;

interface TransactionServicesInterface
{
    public function addPurchase($data);

    public function addIncome($data);

    public function transactionsByAccount($account_id);

}
