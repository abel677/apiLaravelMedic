<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\AppointmentRequest;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Person;
use App\Models\SolicitudAgendarCita;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppointmentRequestCitaController extends Controller
{

    public function index()
    {
    }

    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

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


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Cita registrada',
            ], 200);
        } catch (Exception $e) {

            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cancel($id)
    {
        AppointmentRequest::destroy($id);

        return response()->json([
            "message" => 'Cita cancelada con exito'
        ]);
    }

    public function approved($id)
    {
        $cita = AppointmentRequest::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        $cita->state = 1;
        $cita->save();

        $doctor = Auth()->user();
        $dataDoctor = Person::where('idUser', '=', $doctor->id)->first();

        $patient = Patient::find($cita->patient_id);
        $dataPerson = Person::find($patient->idPerson);
        $user = User::find($dataPerson->idUser);
        $emailData = [
            "user" => $user->email,
            "doctor" => $dataDoctor->name . ' ' . $dataDoctor->lastName,
            "hour" => $cita->appointmentDate
        ];

        Mail::to($user->email)->send(new SendEmail($emailData, "Confirmación de cita medica", "NotificationCita"));

        return response()->json(['message' => 'Cita aceptada exitosamente']);
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
                'doctor_patient.state',
                'doctor_patient.id',
            )
            ->orderBy('doctor_patient.state')
            ->orderByDesc('doctor_patient.id')
            ->get();

        foreach ($appointment as $key => $value) {

            $patient = Person::find($value->idPatient);
            $doctor[$key] = Person::find($value->idDoctor);
            $id = $value->id;


            $appointment[$key] = [
                'idAppointment' => $id,
                'patient' => $patient,
                'currentDate' => $value->currentDate,
                'appointmentDate' => $value->appointmentDate,
                'description' => $value->description,
                'state' => $value->state,
                'doctor' => $doctor[$key],
            ];
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
