<?php

namespace App\Criteria;

use App\Models\Account;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AccountByUserLoggedCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class AccountByUserLoggedCriteriaCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if(!auth()->user()) {
            return $model;
        }

        $account = Account::where('user_id', request()->user()->id)->first();

        if($account) {
            return $model->where('account_id', $account->id);
        }

//
//        if($account) {
//            return $model->where('account_id', $account->id);
//        }

    }
}
