<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TransactionRepository;
use App\Entities\Transaction;
use App\Validators\TransactionValidator;

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

    public function getYearMonthOfAllTransactions(int $month, int $year, int $accountId): Collection
    {
        return $this->with(['transactable:id,amount,description'])->scopeQuery(function ($query) use ($month, $year) {
            return $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        })->orderBy('created_at', $direction = 'desc')->findByField('account_id', $accountId, ['created_at', 'transactable_type', 'transactable_id']);
    }

    public function datesToFilter(int $accountId, string $type) : Collection {
        return DB::table('transactions')->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year')
            ->where('account_id', $accountId)
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    }
}
