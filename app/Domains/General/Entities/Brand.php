<?php

namespace App\Domains\General\Entities;

use App\Core\Abstracts\Entity;
use App\Core\Services\MediaService;
use App\Domains\Item\Entities\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Entity
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
        'order',
        'status',
    ];

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
