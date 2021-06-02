<?php

namespace App\Domains\Auth\Entities;

use App\Core\Abstracts\Entity;

class Comment extends Entity
{

    public $timestamps    = false;

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = [
        'user_id',
        'commentable_type',
        'commentable_id',
    ];


    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
