<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AuthRepository.
 *
 * @package namespace App\Repositories;
 */
interface AuthRepository extends RepositoryInterface
{

    public function login(array $credentials);

    public function logout();


}
