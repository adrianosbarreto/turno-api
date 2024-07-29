<?php

namespace App\Services;

class TransactionService implements TransactionServicesInterface
{
    public function addIncome($data)
    {
        // TODO: Implement addIncome() method.
    }

    public function addPurchase($data)
    {
        //TODO: Implement addPurchase() method.
    }

    public function createTransaction($data)
    {
        return $data;
    }

    public function updateTransaction($data, $id)
    {
        return $data;
    }

    public function deleteTransaction($id)
    {
        return $id;
    }

    public function getTransaction($id)
    {
        return $id;
    }

    public function getTransactionsByAccount($account_id)
    {
        return $account_id;
    }

    public function getTransactionsByCategory($category_id)
    {
        return $category_id;
    }

    public function getTransactionsByType($type)
    {
        return $type;
    }

    public function getTransactionsByMonthYear($month, $year)
    {
        return $month;
    }
}
