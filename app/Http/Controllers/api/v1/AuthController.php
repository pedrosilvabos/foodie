<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class AuthController extends Controller
{
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('api_token')->accessToken;

        return response(['user'=> $user, 'access_token'=>$accessToken]);
    }

    public function login(Request $request){
        $loginData = $request->validate([
            
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(!auth()->attempt($loginData)){
            return response([
                'message'=>'invalid Credentials'
            ]);

            $accessToken = auth()->user()->$user->createToken('authToken')->accessToken;
            return response(['user' => auth()->user(), 'access_token' => $accesstoken]);
        }

    }
}
