<?php

namespace App\Domains\Auth\Entities;

use App\Core\Abstracts\Entity;

class View extends Entity
{

    public $timestamps    = false;

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = [
        'user_id',
        'viewable_type',
        'viewable_id',
        'viewed_at',
    ];

    protected $dates      = ['viewed_at',];

    /**
     * Get the owning viewtable model.
     */
    public function viewtable()
    {
        return $this->morphTo();
    }
}
