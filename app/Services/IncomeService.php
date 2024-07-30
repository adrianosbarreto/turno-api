<?php

namespace App\Services;

use App\Repositories\IncomeRepository;


class IncomeService implements IncomeServicesInterface
{
    private IncomeRepository $incomeRepository;

    public function __construct(IncomeRepository $checkRepository)
    {
        $this->incomeRepository = $checkRepository;
    }


    public function addIncome($data)
    {
        return $this->incomeRepository->create($data);
    }

}
