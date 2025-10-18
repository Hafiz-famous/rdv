<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{
    public function create(User $medecin)
    {
        abort_unless($medecin->role === 'medecin', 404);
        return view('rdv.create', compact('medecin'));
    }

    public function store(Request $request, User $medecin)
    {
        abort_unless($medecin->role === 'medecin', 404);

        $data = $request->validate([
            'scheduled_at'     => ['required','date','after:now'],
            'duration_minutes' => ['nullable','integer','min:10','max:120'],
            'motif'            => ['nullable','string','max:255'],
        ]);

        $start = now()->parse($data['scheduled_at']);
        $duration = $data['duration_minutes'] ?? 20;
        $end = (clone $start)->addMinutes($duration);

        $conflict = Appointment::where('doctor_id', $medecin->id)
            ->where(function($q) use ($start, $end){
                $q->whereBetween('scheduled_at', [$start->copy()->subMinute(), $end]);
            })->exists();

        if ($conflict) {
            return back()->withErrors(['scheduled_at' => 'Créneau indisponible pour ce médecin.'])->withInput();
        }

        Appointment::create([
            'patient_id'       => Auth::id(),
            'doctor_id'        => $medecin->id,
            'scheduled_at'     => $start,
            'duration_minutes' => $duration,
            'motif'            => $data['motif'] ?? null,
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Rendez-vous créé avec succès.');
    }

    public function cancel(Appointment $appointment)
    {
        $this->authorize('cancel', $appointment);
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'Rendez-vous annulé.');
    }
}
