<?php

namespace App\Domains\General\Repositories\Eloquent;

use App\Core\Abstracts\EloquentRepository;
use App\Domains\General\Entities\Brand;
use App\Domains\General\Repositories\Contracts\BrandRepository;

class EloquentBrandRepository extends EloquentRepository implements BrandRepository
{
    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Brand::class;
    }

    /**
     * The Repository Entity.
     *
     * @return object
     */
    public function eloquentstatistics() : object
    {
        $brands = $this->eloquentAll()->get()->map(function ($entity) {
            if($count = $entity->products->count()){
                return [
                    "id"    => $entity->id,
                    "name"  => $entity->name_val,
                    "count" => $count,
                ];
            }
        })->sortBy("count")->filter()->values();
        return $brands;
    }
}
