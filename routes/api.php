<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RolesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::post('login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function(){
Route::post('/user/create', [UserController::class,'store']);
Route::get('/users', [UserController::class,'list']);
Route::get('/user/{id}', [UserController::class,'profile']);
Route::get('/roles', [RolesController::class,'list']);

//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		//Route::get('/roles', [RolesController::class,'list']);
		Route::get('/permissions', [PermissionController::class,'list']);
		Route::post('/role/create', [RolesController::class,'store']);
		Route::get('/role/{id}', [RolesController::class,'show']);
	});

//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission'], function(){
		Route::post('/permission/create', [PermissionController::class,'store']);
		
		Route::get('/permission/{id}', [PermissionController::class,'show']);
	});

});