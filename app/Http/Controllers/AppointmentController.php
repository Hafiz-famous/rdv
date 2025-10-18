<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function show($doctorId)
    {
        return view('patient.rdv_form', ['doctorId' => $doctorId]);
    }

    public function book(Request $request, $doctorId)
    {
        $data = $request->validate([
            'date'       => ['required','date'],
            'start_time' => ['required','date_format:H:i'],
            'end_time'   => ['required','date_format:H:i','after:start_time'],
            'notes'      => ['nullable','string','max:500'],
        ]);

        $exists = Appointment::where('doctor_id', $doctorId)
            ->where('date', $data['date'])
            ->where(function($q) use ($data){
                $q->whereBetween('start_time', [$data['start_time'], $data['end_time']])                  ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
            })->exists();

        if ($exists) {
            return back()->withErrors(['date' => 'Ce créneau est déjà réservé.'])->withInput();
        }

        Appointment::create([
            'doctor_id'  => $doctorId,
            'patient_id' => Auth::id(),
            'date'       => $data['date'],
            'start_time' => $data['start_time'],
            'end_time'   => $data['end_time'],
            'status'     => 'pending',
            'notes'      => $data['notes'] ?? null,
        ]);

        return redirect()->route('patient.dashboard')->with('success','RDV envoyé !');
    }

    public function myAppointments()
    {
        $items = Appointment::where('patient_id', Auth::id())->latest('date')->paginate(10);
        return view('patient.rdv_list', compact('items'));
    }

    public function doctorAppointments()
    {
        $items = Appointment::where('doctor_id', Auth::id())->latest('date')->paginate(10);
        return view('medecin.rdv_list', compact('items'));
    }

    public function confirm(Appointment $appointment)
    {
        $appointment->update(['status' => 'confirmed']);
        return back()->with('success','RDV confirmé.');
    }

    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success','RDV annulé.');
    }
}
