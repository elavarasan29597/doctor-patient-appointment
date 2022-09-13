<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return redirect()->to('doctors/create');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $doctors = Doctor::all();

        $patients = Patient::all();

        return view('create', ['doctors' => $doctors, 'patients' => $patients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'patient' => 'required',
            'start_date_time' => 'required|date_format:Y-m-d H:i|before:end_date_time',
            'end_date_time' => 'required|date_format:Y-m-d H:i|after:start_date_time',
        ]);


        $ifAppointmentCheck =
            Appointment::where('doctor_id', $request->get('doctor'))
            ->where('start_date_time', '<=', $request->get('start_date_time'))
            ->where('end_date_time', '>=', $request->get('end_date_time'))->exists();


        if ($ifAppointmentCheck) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Doctor already have a appointed to other patient, Could you please Change the start and end date time.');
        }


        $insertAppointment = Appointment::create([
            'doctor_id' => $request->get('doctor'),
            'patient_id' => $request->get('patient'),
            'start_date_time' => $request->get('start_date_time'),
            'end_date_time' => $request->get('end_date_time'),
        ]);

        return redirect('/doctors/create')->with('success', 'Appointment Created sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return redirect()->to('doctors/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return redirect()->to('doctors/create');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        return redirect()->to('doctors/create');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        return redirect()->to('doctors/create');
        //
    }
}
