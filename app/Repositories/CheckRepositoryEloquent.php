<?php

namespace App\Repositories;

use App\Criteria\AccountByUserLoggedCriteriaCriteria;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Check;
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
//        $this->pushCriteria(new AccountByUserLoggedCriteriaCriteria());
    }

    public function getChecksByMonthYear(int $accountId, int $month, int $year): Collection
    {
        $this->pushCriteria(AccountByUserLoggedCriteriaCriteria::class);
        return $this->scopeQuery(function ($query) use ($accountId, $month, $year) {
            return $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        })->orderBy('created_at', $direction = 'desc')->all();
    }

    public function getCheckByStatus($status, $month, $year)
    {

        return $this->scopeQuery(function ($query) use ($status, $month, $year) {
            return $query->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', $status);
        })->orderBy('created_at', $direction = 'desc')->all();
    }

    public function getCheckById($id)
    {


        return $this->with(['account', 'account.user'])->find($id);
    }


}
