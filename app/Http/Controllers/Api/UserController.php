<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $token =  $user->createToken('nApp')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'data' => $user,
            'token' => $token
        ], 200);
    }

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('nApp')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'User successfully logged in',
                'data' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'Credentials not match'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'User successfully logged out',
            'data' => $user
        ]);
    }

    public function detail(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => true,
            'message' => 'Data Fetched',
            'data' => $user
        ]);
    }
}
