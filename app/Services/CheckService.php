<?php

namespace App\Services;

class CheckService implements CheckServicesInterface
{
    public function filterByMonthYear($account_id, $month, $year)
    {
        return $account_id;
    }

    public function addCheck($data)
    {
        return $data;
    }

    public function approveCheck($id)
    {
        return $id;
    }

    public function rejectCheck($id)
    {
        return $id;
    }

    public function getCheck($id)
    {
        return $id;
    }
}
