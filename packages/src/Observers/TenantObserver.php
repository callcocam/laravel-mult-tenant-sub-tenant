<?php

namespace Tenant\Observers;

use Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    public function creating(Model $model){
        $model->setAttribute('tenant_id', app(ManagerTenant::class)->getTenantIdentify());
    }

    public function created(Model $model){

    }

    public function updated(Model $model){

        dd($model->users);
    }
}
