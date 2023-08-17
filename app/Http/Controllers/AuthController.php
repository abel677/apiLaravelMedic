<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        try {

            $valueData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = DB::table('users')->where('email', $valueData['email'])->first();

            if (is_null($user)) {
                User::create([
                    'name' => $valueData['name'],
                    'email' => $valueData['email'],
                    'password' => Hash::make($valueData['password']),
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Usuario Creado',
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'El usuario ya existe!',
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            $person = Person::where('idUser', $user->id)->get();
            $jwt = JWTAuth::attempt($credentials);
            $status = true;

            return compact('status', 'user', 'jwt', 'person');

        } else {
            $success = false;
            $message = 'Credenciales invalidas';
            return response()->json([
                'status' => $success,
                'message' => $message
            ], 401);
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        $success = true;
        return compact('success');
    }
}
