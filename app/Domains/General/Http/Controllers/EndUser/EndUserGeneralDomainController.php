<?php

namespace App\Domains\General\Http\Controllers\EndUser;

use DB;
use Session;
use Exception;
use App\Domains\Item\Entities\Product;
use App\Core\Abstracts\ResourceController;
use App\Domains\General\Entities\Category;
use App\Domains\General\Entities\Subcategory;

class EndUserGeneralDomainController extends ResourceController
{
    protected $domainAlias = "generals";

    protected $nameSpace = "enduser";

    public function categoriesIndex()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.categories.index", [
            "title" => GetSettingTransByKey("navbar_trans_categories"),
            "data"  => Product::active()->get()
        ]);
    }

    public function categoriesShow(Category $category)
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.categories.index", [
            "title" => $category->name_val,
            "data" => $category->products
        ]);
    }
}
