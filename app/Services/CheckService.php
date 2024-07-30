<?php

namespace App\Services;

use App\Repositories\CheckRepository;
use Illuminate\Support\Collection;

class CheckService implements CheckServicesInterface
{
    private CheckRepository $checkRepository;

    public function __construct(CheckRepository $checkRepository)
    {
        $this->checkRepository = $checkRepository;
    }

    public function filterByMonthYear($account_id, $month, $year) : Collection
    {
        return $this->checkRepository->getChecksByMonthYear($account_id, $month, $year);
    }

    public function addCheck($data)
    {
        return $this->checkRepository->create($data);
    }

    public function approveCheck($id)
    {
        $this->checkRepository->find($id)->update(['status' => 'approved']);
        $this->
        return ;
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
