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
    function transactionsByAccountAndTypeOrMonthOrYear($account_id, $type, $month, $year);
}
