<?php

namespace App\Services;

interface CheckServicesInterface
{

    public function filterByMonthYear($account_id, $month, $year);

    public function addCheck($data);

    public function approveCheck($id);

    public function rejectCheck($id);

    public function getCheck($id);
}
