<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CheckRepository;
use App\Entities\Check;
use App\Validators\CheckValidator;

/**
 * Class CheckRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CheckRepositoryEloquent extends BaseRepository implements CheckRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Check::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getChecksInMonthAndYearByAccountWithTransaction(int $month, int $year, int $accountId): Collection
    {
        return $this->with(['transactable:id,amount,description'])->scopeQuery(function ($query) use ($month, $year) {
            return $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        })->orderBy('created_at', $direction = 'desc')->findByField('account_id', $accountId, ['created_at', 'transactable_type', 'transactable_id']);
    }
}
