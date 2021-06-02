<?php

namespace App\Domains\Auth\Repositories\Eloquent;

use DB;
use Session;
use Exception;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;
use App\Domains\Auth\Entities\User;
use Illuminate\Database\Eloquent\Model;
use App\Core\Services\AdminPanelService;
use App\Core\Abstracts\EloquentRepository;
use App\Domains\Auth\Repositories\Contracts\UserRepository;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    protected $relations = ["roles", "provider"];

    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return User::class;
    }

    /**
     * Create New Entity.
     *
     * @param  array $data
     * @return Model
     */
    public function eloquentCreate(array $data) : Model
    {
        $data["status"] = config("system.status.active");
        $entity = $this->entity->create($data);
        $entity->assignRole($data["role_id"]);
        return $entity;
    }

    /**
     * Update Entity.
     *
     * @param  integer $id
     * @param  array   $data
     * @return Model
     */
    public function eloquentUpdate(int $id, array $data) : Model
    {
        $data["status"] = config("system.status.active");
        return tap($this->eloquentFind($id), function ($entity) use ($data) {
            if ($entity->roles->first()->id != config("system.roles.super.id")) {
                $entity->update($data);
                if ($data["role_id"]) {
                    $entity->removeRole($entity->roles->first()?? '');
                    $entity->assignRole($data["role_id"]);
                }
            }
        });
    }

    /**
     * Destory Entity.
     *
     * @param $id
     * @return boolean
     * @throws Exception
     */
    public function eloquentDestory($id) : bool
    {
        if (is_array($id)) {
            return $this->entity->destroy(array_diff(request("ids"), [config("system.developer.id")]));
        }
        $entity = $this->entity->withTrashed()->whereId($id)->first();
        if ($entity->roles->first()->id != config("system.roles.super.id")) {
            $entity_role = $entity->roles->first()->id;
            $entity->removeRole($entity_role);
            return $entity->forceDelete();
        }
        return false;
    }
}
