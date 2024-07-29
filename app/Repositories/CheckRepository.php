<?php

namespace App\Repositories;

use App\Models\Check;
use App\Repositories\BaseRepository;

class CheckRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'amount',
        'description',
        'status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Check::class;
    }
}
