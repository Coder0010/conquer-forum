<?php

namespace App\Domains\General\Repositories\Eloquent\Categories;

use App\Core\Abstracts\EloquentRepository;
use App\Domains\General\Entities\Categories\Category;
use App\Domains\General\Repositories\Contracts\Categories\CategoryRepository;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository
{

    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Category::class;
    }

    /**
     * The Repository Entity.
     *
     * @return object
     */
    public function eloquentstatistics() : object
    {
        $categories = $this->eloquentAll()->get()->map(function ($entity) {
            if($count = $entity->products->count()){
                return [
                    "id"    => $entity->id,
                    "name"  => $entity->name_val,
                    "count" => $count,
                ];
            }
        })->sortBy("count")->filter()->values();
        return $categories;
    }

}
