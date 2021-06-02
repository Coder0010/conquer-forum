<?php

namespace App\Domains\Auth\Repositories\Eloquent;

use App\Core\Abstracts\EloquentRepository;
use App\Domains\Auth\Entities\Lead;
use App\Domains\Auth\Repositories\Contracts\LeadRepository;

class EloquentLeadRepository extends EloquentRepository implements LeadRepository
{
    /**
     * The Repository Entity.
     *
     * @return stdClass
     */
    public function entity()
    {
        return Lead::class;
    }
}
