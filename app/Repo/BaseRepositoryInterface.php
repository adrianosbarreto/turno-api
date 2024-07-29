<?php

namespace App\Repo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    public function makeModel();

    /**
     * Paginate records for scaffold.
     */
    public function paginate(int $perPage, array $columns = ['*']): LengthAwarePaginator;

    /**
     * Build a query for retrieving all records.
     */
    public function allQuery(array $search = [], int $skip = null, int $limit = null): Builder;

    /**
     * Retrieve all records with given filter criteria
     */
    public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*']): Collection;

    /**
     * Create model record
     */
    public function create(array $input): Model;

    /**
     * Find model record for given id
     */
    public function find(int $id, array $columns = ['*']);

    /**
     * Update model record for given id
     */
    public function update(array $input, int $id): Model;

    /**
     * Delete model record for given id
     */
    public function delete(int $id);
}
