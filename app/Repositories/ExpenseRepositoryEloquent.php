<?php

namespace App\Repositories;

use App\Models\Expense;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class IncomeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ExpenseRepositoryEloquent extends BaseRepository implements ExpenseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Expense::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
