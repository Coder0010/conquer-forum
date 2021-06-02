<?php

namespace App\Domains\General\Http\Controllers\SAC;

use Illuminate\Support\Collection;
use App\Core\Abstracts\ResourceController;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategorytypeRepository;

class GetSubCategoryType extends ResourceController
{
    /**
     * Get All sub_categories.
     *
     * @return void
     */
    public function __invoke()
    {
        $data = (new EloquentSubcategorytypeRepository)->eloquentAll();
        if (request("id")) {
            $data = $data->whereChildId(request("id"));
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
