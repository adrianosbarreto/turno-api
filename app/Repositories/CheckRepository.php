<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CheckRepository.
 *
 * @package namespace App\Repositories;
 */
interface CheckRepository extends RepositoryInterface
{
    public function getChecksByMonthYear(int $accountId, int $month, int $year);

    public function getCheckByStatus($status, $month, $year);

    public function getCheckById($id);

}
