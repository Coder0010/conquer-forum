<?php

namespace App\Domains\Auth\Entities;

use App\Core\Traits\GlobelScope;
use App\Core\Traits\ModelHelper;
use App\Core\Traits\SearchScope;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Domains\Auth\Entities\Provider;
use App\Core\Services\AdminPanelService;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Domains\Auth\Notifications\PasswordResetNotification;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, GlobelScope, ModelHelper, HasApiTokens, HasRoles, HasMediaTrait, SearchScope, SoftDeletes;

    protected $perPage = 15;

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable   = [
        'name',
        'username',
        'rank',
        'email',
        'phone',
        'date',
        'data',
        'password',
        'email_verified_at',
        'status',
        'order',
    ];

    /*
     * The attributes that are mass assignable to hidden.
     *
     * @var array
     */
    protected $hidden     = [
        'roles',
        'password',
        'remember_token',
        'created_at' ,
        'deleted_at',
    ];

    /*
     * The attributes that are has cutom cast.
     *
     * @var array
     */
    protected $casts      = [
        'date'              => 'array',
        'data'              => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * sent notification of reset password
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * Set User Passsword
     */
    public function setPasswordAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * fetch data.
     */
    public function entityFetchData(array $relations = [])
    {
        $entity = $this;
        if (auth()->user()->hasRole(config('system.roles.super.id'))) {
            $entity = $entity->whereHas('roles', function ($q) {
                return $q->where('roles.id', '<>', config('system.roles.super.id'));
            });
        } elseif (auth()->user()->hasRole(config('system.roles.manager.id'))) {
            $entity = $entity->whereHas('roles', function ($q) {
                return $q->whereNotIn('roles.id', [config('system.roles.super.id'), config('system.roles.manager.id')]);
            });
        } elseif (auth()->user()->hasRole(config('system.roles.sub_manager.id'))) {
            $entity = $entity->whereHas('roles', function ($q) {
                return $q->whereNotIn('roles.id', [config('system.roles.super.id'), config('system.roles.manager.id'), config('system.roles.sub_manager.id')]);
            });
        } elseif (auth()->user()->hasAnyRole(AdminPanelService::RolesGroupedBy('Admin_Guard'))) {
            $entity = $entity->whereHas('roles', function ($q) {
                return $q->whereIn('roles.id', [config('system.roles.normal.id')]);
            });
        }
        return $entity->with($relations);
    }

    /**
     * provider Relationship.
     */
    public function provider() : HasOne
    {
        return $this->hasOne(Provider::class);
    }

    /**
     * order Relationship.
     */
    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
}
