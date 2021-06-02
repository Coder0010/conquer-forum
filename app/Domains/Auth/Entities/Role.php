<?php

namespace App\Domains\Auth\Entities;

use App\Core\Traits\GlobelScope;
use App\Core\Traits\ModelHelper;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use GlobelScope, ModelHelper;

    protected $perPage = 15;

    /**
     * fetch data.
     *
     */
    public function entityFetchData(array $relations = [])
    {
        $entity = $this;
        if (auth()->user()->hasRole(config('system.roles.super.id'))) {
            $entity = $entity->withCount('users');
        } elseif (auth()->user()->hasRole(config('system.roles.manager.id'))) {
            $entity = $entity->where('guard_type', '<>', 'Super_Guard')->where('guard_type', '<>', 'Manager_Guard');
        }
        return $entity->with($relations);
    }
}
