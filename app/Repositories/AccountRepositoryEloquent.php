<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use \App\Models\Account;
use App\Validators\AccountValidator;

/**
 * Class AccountRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Account::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAccountByAccountId($account_id){
        return $this->find($account_id);
    }

    public function createAccount($data){
        return $this->create($data);
    }

    public function accountByUserId($user_id){

        return $this->findByField('user_id', $user_id, ['id', 'user_id', 'type', 'account_number', 'current_balance', 'user_name'])->first();
    }
}
