<?php

namespace App\Repositories;

use App\Models\UserData;
use App\Repositories\BaseRepository;

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
        return UserData::class;
    }
}
