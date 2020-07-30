<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tenant\Acl;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tenant\Acl\Concerns\HasPermissions;
use Tenant\Acl\Contracts\Role as RoleContract;
use Tenant\Traits\TenantTrait;

class Role extends Model implements RoleContract
{
    use HasPermissions, TenantTrait;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['tenant_id', 'user_id', 'name', 'slug', 'special', 'description', 'status', 'created_at', 'updated_at'];
    /**
     * Roles can belong to many users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config('auth.model') ?: config('auth.providers.users.model'))->withTimestamps();
    }
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(config('auth.model') ?: config('auth.providers.users.model'));
    }
    /**
     * Determine if role has permission flags.
     *
     * @return bool
     */
    public function hasPermissionFlags(): bool
    {
        return !is_null($this->special);
    }

    /**
     * Determine if the requested permission is permitted or denied
     * through a special role flag.
     *
     * @return bool
     */
    public function hasPermissionThroughFlag(): bool
    {
        if ($this->hasPermissionFlags()) {
            return !($this->special === 'no-access');
        }
        return true;
    }



}
