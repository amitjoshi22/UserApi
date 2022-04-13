<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthRequest $request){
		
		$auth = Auth::attempt(
            $request->only([
                    'email',
                    'password',
                ])
        );
        if (! $auth) {
            return response([
                'message' => 'Invalid credentials!',
                'success' => 0,
            ]);
        }
        
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return  response([
            'user' => Auth::user(),
            'access_token' => $accessToken,
            'success' => 1,
        ]);
		
	}
}
