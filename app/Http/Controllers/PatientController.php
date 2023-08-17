<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PatientController extends Controller
{
    public function index()
    {
        $patient = Patient::with('persons')->get();
        return response()->json($patient);
    }






    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $patient = Patient::where('idPerson', $id)->get();

        return response()->json($patient);
    }


    public function edit(Patient $patient)
    {
        //
    }


    public function update(Request $request, Patient $patient)
    {
        //
    }


    public function destroy(Patient $patient)
    {
        //
    }
}
