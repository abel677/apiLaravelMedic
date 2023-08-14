<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonaController extends Controller
{
    public function index()
    {
        $person = Person::all();
        return response()->json($person);
    }

    public function store(Request $request)
    {

        try {

            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'lastName' => 'required',
                    'birthDate' => 'required',
                    'typeBlood' => 'required',
                    'direction' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'securityNumber' => 'required',
                    'idUser' => 'required',
                    'idGender' => 'required',
                ]
            );
            /* return response()->json($request); */


            $person = Person::create([
                'name' => $request->name,
                'lastName' => $request->lastname,
                'birthDate' => $request->birthdate,
                'typeBlood' => $request->typeBlod,
                'direction' => $request->direction,
                'email' => $request->email,
                'phone' => $request->phone,
                'securityNumber' => $request->securityNumber,
                'idGender' => $request->idGender,
                'idUser' => $request->idUser
            ]);

            $token = str::random(60);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $token
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function show(Person $person)
    {
    }

    public function update(Request $request, Person $person)
    {
        //
    }


    public function destroy(Person $person)
    {
        //
    }
}
