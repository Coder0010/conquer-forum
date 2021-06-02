<?php

namespace App\Core\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchScope
{
    /**
     * This Scope for returning all data with
     */
    public function scopeSearchBySoftDelete(Builder $builder)
    {
        $soft_delete = request("search_soft_delete");

        if (isset($soft_delete)) {
            if ($soft_delete == 'only-trash') {
                $builder = $builder->onlyTrashed();
            } elseif ($soft_delete == 'with-trash') {
                $builder = $builder->withTrashed();
            }
        }

        return $builder;
    }

    /**
     * This Scope for returning all data with
     */
    public function scopeSearchByStatus(Builder $builder)
    {
        $status = request("search_status");
        if (isset($status)) {
            $builder = $builder->where('status', $status);
        }
        return $builder;
    }

    /**
     * This Scope for returning all data with
     */
    public function scopeSearchByMultiName(Builder $builder)
    {
        $search_name = request("search_name");
        if (isset($search_name)) {
            $builder = $builder->where(function ($query) use ($search_name) {
                $query->where('name_en', 'LIKE', "%$search_name%")
                        ->orWhere('name_ar', 'LIKE', "%$search_name%");
            });
        }
        return $builder;
    }

    /**
     * This Scope for returning all data with
     */
    public function scopeSearchByName(Builder $builder)
    {
        $search_name = request("search_name");
        if (isset($search_name)) {
            $builder = $builder->where('name', 'LIKE', "%$search_name%");
        }
        return $builder;
    }
}
