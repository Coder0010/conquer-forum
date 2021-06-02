<?php

namespace App\Domains\General\Http\Controllers\SAC;

use App\Core\Abstracts\ResourceController;
use Illuminate\Database\Eloquent\Collection;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategoryRepository;

class GetSubCategory extends ResourceController
{
    /**
     * Get All sub_categories.
     *
     * @return void
     */
    public function __invoke()
    {
        $data = (new EloquentSubcategoryRepository)->eloquentAll();
        if (request("id")) {
            $data = $data->whereParentId(request("id"));
        }
        $data = $data->ordered()->active()->get();
        return $this->userJsonResponse($data->map(function ($model) {
            return [
                "id"   => $model->id,
                "text" => $model->name_val,
            ];
        }));
    }
}
