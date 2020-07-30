<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tenant\Http\Controllers;

use Illuminate\Http\Response;
use Tenant\Acl\Permission;
use Tenant\Acl\Role;
use Tenant\Http\AbstractController;
use Tenant\Http\Requests\RoleRequest;

class RoleController extends AbstractController
{

    protected $model = Role::class;
    protected $route = "roles";
    protected $template = "roles";
    protected $prefix = "tenant";

    protected $relationship = 'user.tenant';


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->results['permissions'] = Permission::get();

        return parent::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
       return parent::_store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $this->results['permissions'] = Permission::get();

        return parent::show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->results['permissions'] = Permission::get();

        return parent::edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        return parent::_update($request, $id);
    }

    protected function posEvent($model, $request)
    {
        if($request->has('permissions'))
            $model->permissions()->sync($request->get('permissions'));
    }

}
