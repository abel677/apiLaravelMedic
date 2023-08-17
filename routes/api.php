<?php

use App\Http\Controllers\AppointmentRequestCitaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PersonaController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->group(function () {

    Route::apiResource('/appointment', AppointmentRequestCitaController::class)->only('index', 'store', 'show', 'update', 'destroy');
    Route::apiResource('/doctor', DoctorController::class)->only('index', 'update', 'destroy');
    Route::get('/doctor/{direction}/{specialty}/{schedules}', [DoctorController::class, 'show']);

    Route::apiResource('/gender', GenderController::class)->only('index', 'show', 'update', 'destroy');
    Route::apiResource('/specialties', SpecialtiesController::class)->only('index', 'show', 'update', 'destroy');
    Route::apiResource('/schedules', ScheduleController::class)->only('index', 'show', 'update', 'destroy');
    Route::apiResource('/persons', PersonaController::class)->only('index', 'store', 'show', 'update', 'destroy');
    Route::apiResource('/patient', PatientController::class)->only('index', 'store', 'show', 'update', 'destroy');
});
