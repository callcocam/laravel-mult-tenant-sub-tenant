<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tenant\Acl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tenant\Acl\Concerns\RefreshesPermissionCache;
use Tenant\Acl\Contracts\Permission as PermissionContract;
use Tenant\Traits\TenantTrait;

class Permission extends Model implements PermissionContract
{
    use RefreshesPermissionCache, TenantTrait;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['tenant_id', 'user_id', 'name', 'slug', 'groups', 'description', 'status', 'created_at', 'updated_at'];


    /**
     * Permissions can belong to many roles.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('acl.models.role', Role::class))->withTimestamps();
    }

    /**
     * Roles can belong to many users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config('auth.model') ?: config('auth.providers.users.model'))->withTimestamps();
    }
}
