<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SanctumAuthController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json([
            'message' => 'Register Success',
            'access_token' => $token,
        ]);
    }

    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email',$loginUserData['email'])->first();
        
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'message' => 'Login Success',
            'access_token' => $token,
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        // Fetching all tokens associated with the user and then deleting them one by one
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json([
            "message" => "Logged out successfully"
        ]);
    }

}
