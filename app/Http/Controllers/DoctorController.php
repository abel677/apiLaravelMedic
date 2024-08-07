<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Person;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = Doctor::with(['persons', 'schedules', 'specialties'])->get();
        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($direction, $idSpecialties, $idSchedule)
    {
        $doctors = DB::table('doctors')
            ->join('persons', 'persons.id', '=', 'doctors.idPerson')
            ->join('specialties', 'specialties.id', '=', 'doctors.idSpecialty')
            ->join('schedules', 'schedules.id', '=', 'doctors.idSchedule');

        // Conditionally add where clauses based on the input values
        if ($direction != -1) {
            $doctors->where('persons.direction', '=', $direction);
        }
        if ($idSpecialties != -1) {
            $doctors->where('specialties.id', '=', $idSpecialties);
        }
        if ($idSchedule != -1) {
            $doctors->where('schedules.id', '=', $idSchedule);
        }

        $doctors = $doctors->select(
            'doctors.id as doctor_id',
            'persons.id as idPerson',
            'persons.name',
            'persons.lastName',
            'persons.birthDate',
            'persons.direction',
            'persons.phone',
            'persons.typeBlood',
            'specialties.id as idSpecialty',
            'specialties.specialty',
            'schedules.id as idSchedule',
            'schedules.schedule'
        )->get();

        return response()->json($doctors);
    }


    public function getDoctor($id)
    {
        $doctor = Doctor::where('idPerson', $id)->first();
        return response()->json($doctor);
    }


    public function getPatient($idDoctor)
    {
        $appointment = DB::table('doctor_patient')
            ->join('patients', 'patients.id', '=', 'doctor_patient.patient_id')
            ->join('doctors', 'doctors.id', '=', 'doctor_patient.doctor_id')
            ->where('doctors.id', $idDoctor)
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
            //->where('doctor_patient.state', 0)
            ->get();

        foreach ($appointment as $key => $value) {

            $patient = Person::find($value->idPatient);
            $doctor[$key] = Person::find($value->idDoctor);

            $id = $value->id;


            $appointment[$key] = [
                'id' => $id,
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

    public function update(Request $request, Doctor $doctor)
    {
    }

    public function destroy(Doctor $doctor)
    {
    }
}
