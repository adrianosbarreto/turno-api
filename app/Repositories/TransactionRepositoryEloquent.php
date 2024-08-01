<?php

namespace App\Repositories;

use App\Models\Transaction;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class TransactionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TransactionRepositoryEloquent extends BaseRepository implements TransactionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    function transactionsByAccountAndTypeOrMonthOrYear($account_id, $type, $month, $year){
        return $this->scopeQuery(
            function ($query) use ($account_id, $type, $month, $year) {
                return $query->where('account_id', $account_id)
                    ->when($type, function ($query) use ($type) {
                        $query->where('transactable_type', $type);
                    })
                    ->when($month, function ($query) use ($month) {
                        return $query->whereMonth('created_at', $month);
                    })
                    ->when($year, function ($query) use ($year) {
                        return $query->whereYear('created_at', $year);
                    });
            }
        )->orderBy('created_at', 'DESC')->get();

    }
}
