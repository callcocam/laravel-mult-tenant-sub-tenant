<?php

namespace Tenant\Http\Middleware;

use Tenant\ManagerTenant;
use Closure;

class TenantFileSystems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check())
          $this->setFileSystemsRoot();

        return $next($request);
    }

    public function setFileSystemsRoot(){

        $tenant = app(ManagerTenant::class)->getTenant();
        view()->share('tenant',  $tenant);
        view()->share('user',  auth()->user());
        config()->set('filesystems.disks.tenant.root',
            sprintf("%s/%s", config('filesystems.disks.tenant.root'), $tenant->uuid));

    }
}
