<?php

namespace App\Domains\General\Entities;

use App\Core\Abstracts\Entity;
use App\Core\Services\MediaService;
use App\Domains\Item\Entities\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Entity
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
}
