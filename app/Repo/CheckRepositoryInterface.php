<?php

namespace App\Repo;

interface CheckRepositoryInterface extends BaseRepositoryInterface
{
    public function getFieldsSearchable(): array;

    public function model(): string;

}
