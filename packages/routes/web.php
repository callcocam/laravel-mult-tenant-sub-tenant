<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('set-tenants-id/{id}', 'TenantController@setTenant')->name("set.tenant.tenants");
Route::get('remove-tenants-id', 'TenantController@removeTenant')->name("remove.tenant.tenants");
Route::resource('tenants', 'TenantController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');

