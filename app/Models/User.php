<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tenant\Acl\Concerns\HasRolesAndPermissions;
use Tenant\ManagerTenant;
use Tenant\Tenant;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenant(){

        return $this->belongsTo(Tenant::class);
    }

    public function tenants(){

        return $this->belongsTo(Tenant::class);
    }

    public function posts(){

        return $this->hasMany(Post::class);
    }
    public function value_options(){
        $tenants = $this->tenant()->select(['id','name'])->first();
        $data = [];
        $data[$tenants->id] = $tenants->name;
        if($tenants){
            foreach ($tenants->filiais as $tenant) {
                $data[$tenant->id] = $tenant->name;
            }
        }
        return $data;
    }
}
