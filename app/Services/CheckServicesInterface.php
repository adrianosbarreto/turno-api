<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface CheckServicesInterface
{

    public function filterByMonthYear($account_id, $month, $year) : Collection;

    public function addCheck($data);

    public function approveCheck($id);

    public function rejectCheck($id);

    public function getCheck($id);
}
