<?php


namespace Tenant\Traits;


use Tenant\Observers\TenantObserver;
use Tenant\Scopes\TenantScopes;

trait TenantTrait
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScopes());
        static::observe(new TenantObserver());
    }
}
