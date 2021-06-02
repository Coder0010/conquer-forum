<?php

namespace App\Domains\General\Http\Controllers\SAC;

use App\Core\Abstracts\ResourceController;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;

class GetCategory extends ResourceController
{
    /**
     * Get All sub_categories.
     *
     * @return void
     */
    public function __invoke()
    {
        $data = (new EloquentCategoryRepository)->eloquentAll()->ordered()->active()->get();
        return $this->userJsonResponse($data->map(function ($model) {
            return [
                "id"   => $model->id,
                "text" => $model->name_val,
            ];
        }));
    }
}
