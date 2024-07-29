<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TransactionRepository.
 *
 * @package namespace App\Repositories;
 */
interface TransactionRepository extends RepositoryInterface
{
    public function getYearMonthOfAllTransactions(int $month, int $year, int $accountId): Collection;

    public function datesToFilter(int $accountId) : Collection;
}
