<?php

namespace App\Core\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepository
{
    /**
     * Get Instance From Specified Entity.
     * @return Model
     */
    public function instance() : Model;

    /**
     * Create New Entity.
     * @param  array $data
     * @return Model
     */
    public function eloquentCreate(array $data) : Model;

    /**
     * Update Entity.
     * @param  integer $id
     * @param  array   $data
     * @return Model
     */
    public function eloquentUpdate(int $id, array $data) : Model;

    /**
     * Delete Entity.
     * @param int $id
     * @return boolean
     */
    public function eloquentDelete(int $id) : bool;

    /**
     * Change Statu Of Entity.
     * @param  int   $id
     * @return JsonResponse|null
     */
    public function eloquentChangeStatus(int $id);

    /**
     * Get Statistics of Entity.
     * @return object
     */
    public function eloquentData() : object;

    /**
     * Get All Records From Specified Entity.
     * @return Builder
     */
    public function eloquentAll() : Builder;

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function eloquentPaginate(int $perPage = 0) : LengthAwarePaginator;

    /**
     * Begin querying a model with eager loading.
     * @param  array|string  $relations
     * @return BaseRepository
     */
    public function eloquentWith(...$relations) : BaseRepository;

    /**
     * Find $column Where Equals $value.
     * @return BaseRepository
     */
    public function eloquentWhere($key, $op, $value) : BaseRepository;

    /**
     * Find Entity By ID.
     * @param  int   $id
     * @return Model
     */
    public function eloquentFind(int $id) : Model;

    /**
     * Find $column Where Equals $value.
     * @param  array $criteria
     * @return Collection
     */
    public function eloquentFindWhere(array $criteria) : BaseRepository;

    /**
     * Find $column Where Equals $value.
     * @param  array $criteria
     */
    public function eloquentFindWhereFirst(array $criteria);
}
