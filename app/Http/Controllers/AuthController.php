<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            $person = Person::where('idUser', $user->id)->get();
            //$person = $persons[0];
            $jwt = JWTAuth::attempt($credentials);
            $success = true;
            return compact('success', 'user', 'jwt', 'person');
        } else {
            $success = false;
            $message = 'Credenciales invalidas';
            return response()->json(['success', 'message'],401);
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        $success = true;
        return compact('success');
    }


    public function register(Request $request)
    {

        try {

            $valueData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            User::create([
                'name' => $valueData['name'],
                'email' => $valueData['email'],
                'password' => Hash::make($valueData['password']),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
