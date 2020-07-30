<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */
namespace Tenant\Acl\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Role
{
    /**
     * Roles can belong to many users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany;

    public function hasPermissionFlags(): bool;
    public function hasPermissionThroughFlag(): bool;
}
