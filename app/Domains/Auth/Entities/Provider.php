<?php

namespace App\Domains\Auth\Entities;

use App\Core\Abstracts\Entity;
use App\Domains\Auth\Entities\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Provider extends Entity
{

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'name',
        'provider_id',
        'user_id',
        'avater'
    ];

    /**
     * user Relationship.
     *
     * @return belongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
