<?php

namespace App\Domains\General\Entities\Categories;

use App\Core\Abstracts\Entity;
use App\Domains\Item\Entities\Product;
use App\Domains\Setting\Entities\Gallery;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Entity
{
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
        return $this->with($relations)->whereNull('parent_id')->whereNull('child_id');
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
     * sub_categories Relationship.
     *
     * @return HasMany
     */
    public function sub_categories() : HasMany
    {
        return $this->hasMany(Subcategory::class, 'parent_id');
    }

    /**
     * galleries relation.
     *
     * @return BelongsToMany
     */
    public function galleries() : BelongsToMany
    {
        return $this->belongsToMany(Gallery::class, 'gallery_has_category', 'category_id', 'gallery_id')
                    ->withTimestamps();
    }
}
