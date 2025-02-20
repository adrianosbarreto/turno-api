<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use \App\Models\Income;
use App\Validators\IncomeValidator;

/**
 * Class IncomeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class IncomeRepositoryEloquent extends BaseRepository implements IncomeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Income::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
