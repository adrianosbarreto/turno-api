<?php

namespace App\Repo;

use App\Models\Account;
use App\Repo\BaseRepository;

class UserDataRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'account',
        'current_balance',
        'user_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Account::class;
    }
}
