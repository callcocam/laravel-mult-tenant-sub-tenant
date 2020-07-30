<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Tenant\Acl;

use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Tenant\Acl\Observers\RoleObserver;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return null
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigrations();
        $this->loadMigrations();

        $this->registerGates();
        $this->registerBladeDirectives();


        Role::observe(RoleObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


        $this->mergeConfigFrom(
            __DIR__.'/config/acl.php', 'acl'
        );

        $this->app->singleton('acl', function ($app) {
            $auth = $app->make('Illuminate\Contracts\Auth\Guard');

            return new Acl($auth);
        });
    }

    /**
     * Register the permission gates.
     *
     * @return void
     */
    protected function registerGates()
    {
        Gate::before(function(Authorizable $user, String $permission) {
            try {
                if (method_exists($user, 'hasPermissionTo')) {
                    return $user->hasPermissionTo($permission) ?: null;
                }
            } catch (Exception $e) {
                //
            }
        });
    }

    /**
     * Register the blade directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::if('role', function($role) {
            return auth()->user() and auth()->user()->hasRole($role);
        });

        Blade::if('anyrole', function(...$roles) {
            return auth()->user() and auth()->user()->hasAnyRole(...$roles);
        });

        Blade::if('allroles', function(...$roles) {
            return auth()->user() and auth()->user()->hasAllRoles(...$roles);
        });
    }

    /**
     * Publish the config file.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__.'/config/acl.php' => config_path('acl.php'),
        ], 'config');
    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'acl-migrations');

        $this->publishes([
            __DIR__.'/database/seeds/' => database_path('seeds'),
        ], 'acl-seeds');

        $this->publishes([
            __DIR__.'/database/factories/' => database_path('factories'),
        ], 'acl-factories');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('acl.migrate', true)) {
            $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        }
    }

}
