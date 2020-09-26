<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        $url =  str_replace(url('/'), '', url()->previous());

        return response([
            'status' => 'success',
            'data' => $user,
            'url' => $url
        ], 200);
    }

    public function login(Request $request)
    {

        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 400);

        }
        return response([
            'status' => 'success'
        ])
            ->header('Authorization', $token);
    }

    public function user(Request $request)
    {

        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}
