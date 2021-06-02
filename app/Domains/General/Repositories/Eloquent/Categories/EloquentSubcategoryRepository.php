<?php

namespace App\Domains\General\Repositories\Eloquent\Categories;

use Illuminate\Support\Collection;
use App\Core\Abstracts\EloquentRepository;
use App\Domains\General\Entities\Categories\Subcategory;
use App\Domains\General\Repositories\Contracts\Categories\SubcategoryRepository;

class EloquentSubcategoryRepository extends EloquentRepository implements SubcategoryRepository
{
    protected $relations = ["category",];

    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Subcategory::class;
    }

    /**
     * The Repository Entity.
     *
     * @return object
     */
    public function eloquentstatistics() : object
    {
        $sub_categories = $this->eloquentAll()->get()->map(function ($entity) {
            if($count = $entity->products->count()){
                return [
                    "id"    => $entity->id,
                    "name"  => $entity->name_val,
                    "count" => $count,
                ];
            }
        })->sortBy("count")->filter()->values();
        return $sub_categories;
    }
}
