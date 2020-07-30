<?php

namespace Tenant\Policies;

use App\Models\User;
use Tenant\Tenant;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Tenant\Tenant  $tenant
     * @return mixed
     */
    public function view(User $user, Tenant $tenant)
    {
        return !$tenant->tenant_id;
    }

}
