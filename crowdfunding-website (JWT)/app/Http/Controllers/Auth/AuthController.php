<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{   
    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'email' => $request['email'],
            'name' => $request['name'],
            'password' => Hash::make($request->password),
        ]);

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'User berhasil register', 
            'data' => $data
        ],201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Email Dan Password Invalid'], 401);
        }

        $data['token'] = $token;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'User berhasil login', 
            'data' => $token
        ], 200);
    }

    public function password(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::create([
            'password' => Hash::make($request->password),
        ]);

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Password berhasil di update', 
            'data' => $data
        ],201);
    }

    public function logout(){

        auth()->logout();
    
            return response()->json(['message' => 'Logout berhasil']);
    }

} 
