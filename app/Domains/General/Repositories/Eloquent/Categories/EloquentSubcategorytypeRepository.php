<?php

namespace App\Domains\General\Repositories\Eloquent\Categories;

use Illuminate\Support\Collection;
use App\Core\Abstracts\EloquentRepository;
use App\Domains\General\Entities\Categories\Subcategorytype;
use App\Domains\General\Repositories\Contracts\Categories\SubcategorytypeRepository;

class EloquentSubcategorytypeRepository extends EloquentRepository implements SubcategorytypeRepository
{
    protected $relations = ["subcategory",];

    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Subcategorytype::class;
    }

    /**
     * The Repository Entity.
     *
     * @return object
     */
    public function eloquentstatistics() : object
    {
        $sub_category_types = $this->eloquentAll()->get()->map(function ($entity) {
            if($count = $entity->products->count()){
                return [
                    "id"    => $entity->id,
                    "name"  => $entity->name_val,
                    "count" => $count,
                ];
            }
        })->sortBy("count")->filter()->values();
        return $sub_category_types;
    }
}
