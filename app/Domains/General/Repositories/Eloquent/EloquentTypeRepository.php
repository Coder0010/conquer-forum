<?php

namespace App\Domains\General\Repositories\Eloquent;

use Illuminate\Support\Collection;
use App\Core\Abstracts\EloquentRepository;
use App\Domains\General\Entities\Type;
use App\Domains\General\Repositories\Contracts\TypeRepository;

class EloquentTypeRepository extends EloquentRepository implements TypeRepository
{

    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Type::class;
    }

    /**
     * The Repository Entity.
     *
     * @return object
     */
    public function eloquentstatistics() : object
    {
        $types = $this->eloquentAll()->get()->map(function ($entity) {
            if($count = $entity->products->count()){
                return [
                    "id"    => $entity->id,
                    "name"  => $entity->name_val,
                    "count" => $count,
                ];
            }
        })->sortBy("count")->filter()->values();
        return $types;
    }

}
