<?php

namespace App\Core\Traits;

use Illuminate\Database\Eloquent\Builder;

trait GlobelScope
{
    /**
     * This Scope for returning all data with status active
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->whereStatus(config("system.status.active"));
    }

    /**
     * This Scope for returning all data with status pending
     */
    public function scopePending(Builder $builder)
    {
        return $builder->whereStatus(config("system.status.pending"));
    }

    /**
     * This Scope for returning all data with status deactivate
     */
    public function scopeDeactivate(Builder $builder)
    {
        return $builder->whereStatus(config("system.status.deactivate"));
    }

    /**
     * This Scope for returning all data with is_promoted true
     */
    public function scopePromoted(Builder $builder)
    {
        return $builder->whereIsPromoted(config("system.answers.yes"));
    }

    /**
     * This Scope for returning all data with order asc
     */
    public function scopeOrdered(Builder $builder)
    {
        return $builder->orderBy("created_at", "desc");
        return $builder->orderBy("order", "asc");
    }
}
