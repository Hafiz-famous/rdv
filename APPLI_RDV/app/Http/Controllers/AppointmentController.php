<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        // Liste simple des médecins (affiche le nom lié à user)
        $doctors = Doctor::with('user:id,name')->orderBy('id','desc')->get()
            ->map(fn($d)=>['id'=>$d->id,'label'=>$d->user?->name.' — '.$d->specialite]);

        return view('rendezvous.create', [
            'doctors' => $doctors,
            'prefillDoctor' => $request->integer('doctor'), // optionnel ?doctor=ID
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id'    => ['required','exists:doctors,id'],
            'scheduled_at' => ['required','date','after:now'],
            'reason'       => ['nullable','string','max:1000'],
        ],[
            'scheduled_at.after' => "La date/heure doit être dans le futur."
        ]);

        // (Optionnel) empêcher un double RDV patient au même créneau
        $exists = Appointment::where('user_id', $request->user()->id)
            ->where('scheduled_at', $validated['scheduled_at'])->exists();
        if ($exists) {
            return back()->withErrors(['scheduled_at' => 'Vous avez déjà un RDV à ce créneau.'])
                         ->withInput();
        }

        Appointment::create([
            'user_id'      => $request->user()->id,
            'doctor_id'    => $validated['doctor_id'],
            'scheduled_at' => $validated['scheduled_at'],
            'status'       => 'pending',
            'reason'       => $validated['reason'] ?? null,
        ]);

        return redirect()->route('patient.dashboard')
            ->with('success', 'Votre demande de rendez-vous a été enregistrée.');
    }
}
