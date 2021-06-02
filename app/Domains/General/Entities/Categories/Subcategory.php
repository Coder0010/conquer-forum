<?php

namespace App\Domains\General\Entities\Categories;

use App\Core\Abstracts\Entity;
use App\Domains\Item\Entities\Product;
use App\Domains\General\Entities\Categories\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategory extends Entity
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
        return $this->with($relations)->whereNotNull('parent_id')->whereNull('child_id')->whereHas('category');
    }

    /**
     * products Relationship.
     *
     * @return HasMany
     */
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * category Relationship.
     *
     * @return belongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * sub_category_types Relationship.
     *
     * @return HasMany
     */
    public function sub_category_types() : HasMany
    {
        return $this->hasMany(Subcategorytype::class, 'child_id');
    }
}
