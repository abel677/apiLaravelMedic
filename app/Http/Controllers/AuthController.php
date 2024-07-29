<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use App\Models\AppointmentRequest;
use App\Models\Person;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function confirmAccount($token)
    {


        try {
            $decode = PersonalAccessToken::findToken($token);

            if (!$decode) {
                return null;
            }

            $url = config('app.url_front');
            $user  = User::find($decode->name);



            if ($user->email_verified_at) {
                return redirect($url);
            }


            $user->email_verified_at = now();
            $user->save();
            return redirect($url);
        } catch (\Throwable $th) {
            return response()->json([
                "error" =>  $th->getMessage()
            ]);
        }
    }







    public function register(Request $request)
    {
        try {

            DB::beginTransaction();
            $valueData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $userFound = DB::table('users')->where('email', $valueData['email'])->first();

            if (($userFound)) {
                return response()->json([
                    'status' => false,
                    'message' => 'El usuario ya existe!',
                ], 400);
            }

            $user = User::create([
                'name' => $valueData['name'],
                'email' => $valueData['email'],
                'password' => Hash::make($valueData['password']),
            ]);


            UserRole::create([
                'idRole' => 3,
                'idUser' => $user->id
            ]);



            $token = $user->createToken($user->id)->plainTextToken;


            $url = config('app.url');

            $mailData = [

                "usuario" => $user->email,
                "link" => $url . '/api/confirm/account/' . $token
            ];

            Mail::to($user->email)->send(new ConfirmEmail($mailData));


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Se ha enviado un correo a ' . $user->email . '. Por favor, verifica tu bandeja de entrada y sigue las intrucciones para confirmar tu cuenta.',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
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
            $jwt = JWTAuth::attempt($credentials);
            $user = Auth::guard('api')->user();


            $roles = DB::table('usersRoles')
                ->join('roles', 'roles.id', '=', 'usersRoles.idRole')
                ->join('users', 'users.id', '=', 'usersRoles.idUser')
                ->where('users.id', $user->id)
                ->select('roles.*')
                ->get();


            $status = true;

            return compact('status', 'user', 'jwt', 'roles');
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


    public function getUser($id)
    {
        $user = User::find($id);


        $roles = DB::table('usersRoles')
            ->join('roles', 'roles.id', '=', 'usersRoles.idRole')
            ->join('users', 'users.id', '=', 'usersRoles.idUser')
            ->where('users.id', $user->id)
            ->select('roles.*')
            ->get();


        $status = true;

        return compact('status', 'user', 'roles');
    }
}
