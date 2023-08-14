<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Person;
use App\Models\SolicitudAgendarCita;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentRequestCitaController extends Controller
{

    public function index()
    {
    }

    public function store(Request $request)
    {
        try {

            $valueData = $request->validate([
                'patient_id' => 'required',
                'doctor_id' => 'required',
                'appointmentDate' => 'required',
                'description' => 'required'
            ]);

            AppointmentRequest::create([

                'patient_id' => $valueData['patient_id'],
                'doctor_id' => $valueData['doctor_id'],
                'appointmentDate' => $valueData['appointmentDate'],
                'currentDate' => Carbon::now(),
                'description' => $valueData['description'],
                'state' => false,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cita registrada',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function show($idPatient)
    {

        $appointment = DB::table('doctor_patient')
            ->join('patients', 'patients.id', '=', 'doctor_patient.patient_id')
            ->join('doctors', 'doctors.id', '=', 'doctor_patient.doctor_id')
            ->where('patients.id', $idPatient)
            ->select(
                'patients.idPerson as idPatient',
                'doctors.idPerson as idDoctor',
                'doctor_patient.currentDate',
                'doctor_patient.appointmentDate',
                'doctor_patient.description',
                'doctor_patient.state'
            )
            ->orderBy('doctor_patient.state')
            ->orderByDesc('doctor_patient.id')
            ->get();

        foreach ($appointment as $key => $value) {

            $patient = Person::find($value->idPatient);
            $doctor[$key] = Person::find($value->idDoctor);


            $appointment[$key] = [
                'patient' => $patient,
                'currentDate' => $value->currentDate,
                'appointmentDate' => $value->appointmentDate,
                'description' => $value->description,
                'state' => $value->state,
                'doctor' => $doctor[$key],
            ];

            // $currentDate[$key] = $value->currentDate;
            // $appointmentDate[$key] = $value->appointmentDate;
            // $description[$key] = $value->description;
        }

        return response()->json($appointment);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppointmentRequest $appointmentRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentRequest $appointmentRequest)
    {
        //
    }
}
