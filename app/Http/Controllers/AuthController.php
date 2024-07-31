<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use App\Mail\SendEmail;
use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function changePassword(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required',
            ]);

            $user = User::where('email', '=', $request->email)->first();
            if (!$user) throw  new Exception("El correo proporcionado no existe", Response::HTTP_BAD_REQUEST);

            $generatedPassword = Str::random(15);

            $user->password = Hash::make($generatedPassword);
            $user->save();


            $emailData = [
                "user" => $user->email,
                "password" => $generatedPassword
            ];

            Mail::to($user->email)->send(new SendEmail($emailData, "Cambio de contraseña", "ChangePassword"));



            return response()->json([
                'message' => 'Se ha enviado un correo con la nueva contraseña a ' . $user->email . '. Por favor, verifica tu bandeja.',
            ], 200);
        } catch (\Throwable $th) {
            throw  new Exception($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }


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
            throw  new Exception($th->getMessage(), Response::HTTP_BAD_REQUEST);
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

        // Intentar autenticar al usuario
        if (!$token = $this->attemptLogin($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Credenciales invalidas'
            ], 401);
        }

        // Obtener el usuario autenticado
        $user = Auth::guard('api')->user();

        // Obtener los roles del usuario
        $roles = $this->getUserRoles($user->id);

        // Responder con éxito
        return response()->json([
            'status' => true,
            'user' => $user,
            'jwt' => $token,
            'roles' => $roles
        ]);
    }

    private function attemptLogin(array $credentials)
    {
        if (Auth::guard('api')->attempt($credentials)) {
            return JWTAuth::attempt($credentials);
        }
        return false;
    }

    private function getUserRoles($userId)
    {
        return DB::table('usersRoles')
            ->join('roles', 'roles.id', '=', 'usersRoles.idRole')
            ->join('users', 'users.id', '=', 'usersRoles.idUser')
            ->where('users.id', $userId)
            ->select('roles.*')
            ->get();
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
