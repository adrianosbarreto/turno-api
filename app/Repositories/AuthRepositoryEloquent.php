<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AuthRepository;
use App\Entities\Auth;
use App\Validators\AuthValidator;

/**
 * Class AuthRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AuthRepositoryEloquent extends BaseRepository implements AuthRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createUserByNameAndEmailAndPassword(string $name, string $email, string $password): User
    {
        return new User();
    }

}
