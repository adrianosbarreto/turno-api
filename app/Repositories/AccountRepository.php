<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AccountRepository.
 *
 * @package namespace App\Repositories;
 */
interface AccountRepository extends RepositoryInterface
{
    public function getAccountByAccountId($account_id);

    public function createAccount($data);

    public function accountByUserId($user_id);
}
