<?php


namespace Tenant;


class ManagerTenant
{


    public function getTenantIdentify(){


        if(session()->has('tenant_id'))
            return session()->get('tenant_id');

        return $this->getTenant()->id;
    }

    public function getTenantId(){

        return $this->getTenant()->tenant_id;
    }

    public function getTenant(){

        if(session()->has('tenant_id'))
            return Tenant::find(session()->get('tenant_id'));

        return auth()->user()->tenant;
    }
}
