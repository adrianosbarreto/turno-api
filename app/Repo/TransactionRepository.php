<?php

namespace App\Repo;

use App\Models\Transaction;
use App\Repo\BaseRepository;

class TransactionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'type',
        'amount',
        'date',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Transaction::class;
    }
}
