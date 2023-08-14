<?php

namespace App\Http\Controllers;

use App\Models\Gender;

class GenderController extends Controller
{

    public function index()
    {
        $genders = Gender::all();
        return response()->json($genders);
    }
}
