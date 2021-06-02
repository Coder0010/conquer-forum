<?php

namespace App\Domains\Auth\Repositories\Eloquent;

use Artisan;
use Illuminate\Support\Collection;
use App\Domains\Auth\Entities\Role;
use App\Domains\Auth\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use App\Core\Abstracts\EloquentRepository;
use App\Domains\Auth\Repositories\Contracts\RoleRepository;

class EloquentRoleRepository extends EloquentRepository implements RoleRepository
{
    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Role::class;
    }

    /**
     * The Repository Data By Sub Query.
     */
    public function eloquentData() : object
    {
        return $this->entity->entityFetchData($this->relations)->orderBy("order", "asc")->paginate()->setPath(route("admin.roles.index"));
    }

    /**
     * Create New Entity.
     *
     * @param  array $data
     * @return Model
     */
    public function eloquentCreate(array $data) : Model
    {
        $entity = $this->entity->create([
            "name"       => $data["name"],
            "alias_name" => $data["alias_name"],
            "guard_name" => "web",
        ]);
        $entity->permissions()->sync(array_filter($data["permissions"]), true);
        Artisan::call("permission:cache-reset");
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
        $role = $this->eloquentFind($id);
        if ($role->id != config("system.roles.super.id") && $role->id != config("system.roles.normal.id")) {
            Artisan::call("permission:cache-reset");
            return tap($role, function ($entity) use ($data) {
                $entity->update([
                    "alias_name" => $data["alias_name"],
                ]);
                $entity->permissions()->sync(array_filter($data["permissions"]), true);
            });
        } else {
            return $role;
        }
    }

    /**
     * Delete Entity.
     *
     * @param $id
     * @return boolean
     */
    public function eloquentDelete($id) : bool
    {
        if (is_array($id)) {
            $ids = array_diff(request("ids"), [config("system.roles.super.id"), config("system.roles.normal.id")]);
            return $this->entity->destroy($ids);
        }
        $role = $this->eloquentFind($id);
        if ($role->id != config("system.roles.super.id") && $role->id != config("system.roles.normal.id")) {
            $oldRoleUsers = User::role($role)->get();
            foreach ($oldRoleUsers as $user) {
                $user->removeRole($role);
                $user->assignRole(config("system.roles.normal.id"));
            }
            return $role->delete();
        }
        return false;
    }
}
