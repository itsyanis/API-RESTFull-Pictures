<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;

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
}
