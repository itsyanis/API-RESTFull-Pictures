<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $newUser = User::create([
            'name'  => ucfirst($request->name),
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $newUser->createToken('userToken')->plainTextToken;

        return response()->json([
            'user' => $newUser,
            'token'=> $token,
            'status' => 201
        ]);
    }


    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->firstOrFail();
        
        if(Hash::check($request->password,$user->password)) {
           
            $token = $user->createToken('userToken')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token'=> $token,
                'status' => 200
            ]);
        }

        return response()->json([
            'message' => 'Login failed',
            'status'  =>  401 
        ]);
    }

    public function logout() {
        
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out'
        ]);
    } 

}
