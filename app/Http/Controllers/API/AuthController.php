<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $token = $user->createToken('Usertoken')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message' => 'Sesión cerrada correctamente']);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            // return response(['message' => 'Credenciales no válidas'], 401);
            return response()->json([
                'errors' => [
                    'message' => [
                        'Credenciales no válidas.'
                    ]
                ]
            ], 401);
        } else {
            $token = $user->createToken('Usertoken')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ], 200);
        }
    }
    public function index()
    {
        return view('login.login');
    }
}
