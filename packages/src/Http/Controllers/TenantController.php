<?php

namespace Tenant\Http\Controllers;

use Illuminate\Http\Response;
use Tenant\Http\AbstractController;
use Tenant\Http\Requests\TenantRequest;
use Tenant\ManagerTenant;
use Tenant\Tenant;

class TenantController extends AbstractController
{
    protected $model = Tenant::class;
    protected $route = "tenants";
    protected $template = "tenants";
    protected $prefix = "tenant";

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return view(sprintf('tenant::%s.index', $this->template));
    }

    public function create()
    {
        if (app(ManagerTenant::class)->getTenantId())
        {
            return back();
        }
        return parent::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TenantRequest $request
     * @return Response
     */
    public function store(TenantRequest $request)
    {
        $this->data = $request->all();

        $this->data['tenant_id'] =  $request->user()->tenant_id;

        return parent::_store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function setTenant ($id)
    {
        session()->put('tenant_id',$id);
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function removeTenant ()
    {
        session()->forget('tenant_id');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param TenantRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(TenantRequest $request, $id)
    {
        return parent::_update($request, $id);
    }

}
