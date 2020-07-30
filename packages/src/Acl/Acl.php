<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tenant\Acl;

use Tenant\Acl\Tactics\AssignRoleTo;
use Tenant\Acl\Tactics\GivePermissionTo;
use Tenant\Acl\Tactics\RevokePermissionFrom;

class Acl
{
    /**
     * Fetch an instance of the Role model.
     *
     * @return Role
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function role()
    {
        return app()->make(config('acl.models.role'));
    }

    /**
     * Fetch an instance of the Permission model.
     *
     * @return Permission
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permission()
    {
        return app()->make(config('acl.models.permission'));
    }

    /**
     * Assign roles to a user.
     *
     * @param string|array $roles
     * @return AssignRoleTo
     */
    public function assign($roles): AssignRoleTo
    {
        return new AssignRoleTo($roles);
    }

    /**
     * Give permissions to a user or role
     *
     * @param string|array $permissions
     * @return GivePermissionTo
     */
    public function give($permissions): GivePermissionTo
    {
        return new GivePermissionTo($permissions);
    }

    /**
     * Revoke permissions from a user or role
     *
     * @param string|array $permissions
     * @return RevokePermissionFrom
     */
    public function revoke($permissions): RevokePermissionFrom
    {
        return new RevokePermissionFrom($permissions);
    }
}
