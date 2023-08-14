<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Specialties;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{

    public function index()
    {
        $specialties = Specialties::all();
        return response()->json($specialties);
    }





    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialties $specialties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialties $specialties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialties $specialties)
    {
        //
    }
}
