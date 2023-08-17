<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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



            $validateData = $request->validate([
                'name' => 'required',
                'lastName' => 'required',
                'birthDate' => 'required',
                'typeBlood' => 'required',
                'direction' => 'required',
                'phone' => 'required',
                'securityNumber' => 'required',
                'idUser' => 'required',
                'idGender' => 'required',
            ]);

            $person = Person::create([
                'name' => $validateData['name'],
                'lastName' => $validateData['lastName'],
                'birthDate' => $validateData['birthDate'],
                'typeBlood' => $validateData['typeBlood'],
                'direction' => $validateData['direction'],
                'phone' => $validateData['phone'],
                'idUser' => $validateData['idUser'],
                'idGender' => $validateData['idGender']
            ]);

            $patient = Patient::create([
                'idPerson' => $person->id,
                'securityNumber' => $validateData['securityNumber'],
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

    public function show($id)
    {
        $person = DB::table('patients')
            ->join('persons', 'persons.id', '=', 'patients.idPerson')
            ->select(
                'persons.id',
                'persons.name',
                'persons.lastName',
                'persons.birthDate',
                'persons.typeBlood',
                'persons.direction',
                'persons.phone',
                'persons.idUser',
                'persons.idGender',
                'patients.securityNumber',
                'patients.id as idPatient'
            )->where('persons.idUser', $id)->get();

        return response()->json($person);
    }

    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        if (is_null($person)) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }


        $validateData = $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'birthDate' => 'required',
            'typeBlood' => 'required',
            'direction' => 'required',
            'phone' => 'required',
            'securityNumber' => 'required',
            'idUser' => 'required',
            'idGender' => 'required',
            'idPatient' => 'required',
        ]);

        $patient = Patient::find($validateData['idPatient']);
        $patient->securityNumber = $validateData['securityNumber'];
        $patient->save();

        $person->name = $validateData['name'];
        $person->lastName = $validateData['lastName'];
        $person->birthDate = $validateData['birthDate'];
        $person->typeBlood = $validateData['typeBlood'];
        $person->direction = $validateData['direction'];
        $person->phone = $validateData['phone'];
        $person->idUser = $validateData['idUser'];
        $person->idGender = $validateData['idGender'];
        $person->save();

        return response()->json(['message' => 'Datos actualizados'], 201);
    }


    public function destroy(Person $person)
    {
        //
    }
}
