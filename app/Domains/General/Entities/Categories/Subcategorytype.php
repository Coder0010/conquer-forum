<?php

namespace App\Domains\General\Entities\Categories;

use App\Core\Abstracts\Entity;
use App\Domains\Item\Entities\Product;
use App\Domains\General\Entities\Categories\Subcategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategorytype extends Entity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table      = 'categories';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'name_en',
        'name_ar',
        'data',
        'parent_id',
        'child_id',
        'order',
        'status',
    ];

    /**
     * fetch data.
     *
     */
    public function entityFetchData(array $relations = [])
    {
        return $this->with($relations)->whereNull('parent_id')->whereNotNull('child_id')->whereHas('subcategory');
    }

    /**
     * Subcategory Relationship.
     *
     * @return belongsTo
     */
    public function subcategory() : BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'child_id')->with('category');
    }

    /**
     * products Relationship.
     *
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_has_sub_category_types', 'subcategorytype_id', 'product_id');
    }
}
