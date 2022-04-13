<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
	public function list(Request $request){
		return response([
		'roles' => Role::get(),
		'success' => 1		
		]);
	}
	
    public function store(RoleRequest $request){
		
		// store user information
        $role = Role::create([
            'guard_name' => 'web',
            'name' => $request->name,
        ]);
		// assign permission to role
        if (isset($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }
		if ($role) {
            return response([
                'message' => 'Role created succesfully!',
                'role' => $role,
                'success' => 1,
            ]);
        }

        return response([
                'message' => 'Sorry! Failed to create role!',
                'success' => 0,
            ]);
	}
	
	public function show($id, Request $request)
    {
        $role = Role::with('permissions')->find($id);
        if ($role) {
            return response([
                'role' => $role,
                'success' => 1,
            ]);
        } else {
            return response([
                'message' => 'Sorry! Not found!',
                'success' => 0,
            ]);
        }
    }


    public function delete($id, Request $request)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();

            return response([
                'message' => 'Role has been deleted',
                'success' => 1,
            ]);
        } else {
            return response([
                'message' => 'Sorry! Not found!',
                'success' => 0,
            ]);
        }
    }

}
