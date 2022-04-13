<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function list(Request $request)
	{
		return response([
			'users' => User::all(),
			'success' => 1		
		]);
	}
	
    public function store(UserRequest $request){
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password)		
		]);
		// assign new role to the user
		$role = $user->assignrole($request->role);	
		if($user){
			return response([
			'message'=>'User created succesfully!',
			'user'=> $user,
			'success'=>1
			
			]);
		}
		return response([
		'message'=> 'Sorry! Failed to create user!',
		'success'=>1		
		]);
	}
	public function profile($id, Request $request){
		$user = User::find($id);
        if ($user) {
            return response([
                'user' => $user,
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
