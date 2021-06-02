<?php

namespace App\Domains\Setting\Http\Controllers\SAC;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Domains\Item\Entities\Product;
use App\Core\Abstracts\ResourceController;
use App\Domains\General\Entities\Category;

class GetSettingMedia extends ResourceController
{
    /**
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        return ShowMultiImagesFromStorage(GetSettingMedia($request->key), "Multi-Setting-Collection");
    }
}
