<?php

namespace Tenant\Providers;

use Illuminate\Support\ServiceProvider;
use Tenant\Acl\AclServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(AclServiceProvider::class);
        $this->app->register(\Tenant\Providers\RouteServiceProvider::class);

        $this->loadViewsFrom(realpath(__DIR__ .'/../../resources/views'), 'tenant');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([

            realpath(__DIR__ . '/../../config/tenant.php') => config_path('tenant.php')

        ]);
    }
}
