<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Mail\AppointmentStatusChanged;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentAdminController extends Controller
{
    // Médecin : liste de ses RDV (à confirmer/annuler)
    public function index()
    {
        abort_unless(Auth::user()?->role === 'medecin', 403);

        $rdvs = Appointment::where('doctor_id', Auth::id())
            ->orderBy('scheduled_at')
            ->paginate(20);

        return view('medecin.appointments', compact('rdvs'));
    }

    public function confirm(Appointment $appointment)
    {
        abort_unless(Auth::user()?->role === 'medecin', 403);
        abort_unless($appointment->doctor_id === Auth::id(), 403);

        $appointment->update(['status' => 'confirmed']);

        // Notifier le patient
        if ($appointment->patient?->email) {
            Mail::to($appointment->patient->email)->send(new AppointmentStatusChanged($appointment));
        }

        return back()->with('success','Rendez-vous confirmé.');
    }

    public function decline(Appointment $appointment)
    {
        abort_unless(Auth::user()?->role === 'medecin', 403);
        abort_unless($appointment->doctor_id === Auth::id(), 403);

        $appointment->update(['status' => 'cancelled']);

        // Notifier le patient
        if ($appointment->patient?->email) {
            Mail::to($appointment->patient->email)->send(new AppointmentStatusChanged($appointment));
        }

        return back()->with('success','Rendez-vous annulé.');
    }
}
