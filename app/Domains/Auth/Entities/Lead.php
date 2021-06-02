<?php

namespace App\Domains\Auth\Entities;

use App\Core\Abstracts\Entity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Entity
{

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'name',
        'type',
        'email',
        'subject',
        'phone',
        'description',
        'file',
        'country_id',
        'city_id',
        'status',
        'order',
    ];

    const ContactType = 'contact-us';

    const CareerType  = 'career-us';

    /**
     * This Scope for returning all data with status active
     */
    public function entityFetchData(array $relations = [])
    {
        return $this->with($relations);
    }
}
