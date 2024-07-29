<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IncomeRepository;
use App\Entities\Income;
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
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IncomeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
