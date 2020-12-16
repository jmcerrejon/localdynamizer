<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];

        $appointments = Appointment::get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->title,
                'start' => $appointment->start_time,
                'url'   => route('appointment.edit', $appointment->id),
            ];
        }

        return view('calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \app\Http\Requests\AppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $appointment = $request->validated();
        $appointment['user_id'] = Auth::user()->id;
        Appointment::create($appointment);

        return redirect()->route('appointment.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('calendar.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        return redirect()->route('appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointment.index');
    }
}
