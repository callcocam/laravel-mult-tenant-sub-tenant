<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tenant\Http\Controllers;

use Illuminate\Http\Response;
use Tenant\Acl\Permission;
use Tenant\Http\AbstractController;
use Tenant\Http\Requests\PermissionRequest;

class PermissionController extends AbstractController
{
    protected $model = Permission::class;
    protected $route = "permissions";
    protected $template = "permissions";
    protected $prefix = "tenant";



    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $request
     * @return Response
     */
    public function store(PermissionRequest $request)
    {
        return parent::_store($request);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param PermissionRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(PermissionRequest $request, $id)
    {
       return parent::_update($request, $id);
    }

}
