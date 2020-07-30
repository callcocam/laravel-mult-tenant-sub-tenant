<?php

namespace Tenant\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenant\Acl\Role;

class LoginCreateRole
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if(!$event->user->roles()->count()){
            $role = $event->user->roles()->create([
                'user_id' => $event->user->id,
                'name' => "Super Admin",
                'slug' => "super-admin",
                'special' => "all-access",
            ]);
            $event->user->roles()->sync($role);
        };
    }
}
