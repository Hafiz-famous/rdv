// app/Http/Controllers/RendezVousController.php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use App\Models\Doctor;              // <-- AJOUT
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RendezVousController extends Controller
{
    public function index(Request $request)
    {
        $query = RendezVous::query()
            ->when($request->date, fn($q, $date) =>
                $q->whereDate('scheduled_at', $date))
            ->when($request->status, fn($q, $status) =>
                $q->where('status', $status))
            ->when($request->q, function ($q, $term) {
                $q->where(function ($sub) use ($term) {
                    $sub->where('patient_name', 'like', "%{$term}%")
                        ->orWhere('patient_phone', 'like', "%{$term}%")
                        ->orWhere('reason', 'like', "%{$term}%");
                });
            })
            ->orderBy('scheduled_at', 'asc');

        $rendezvous = $query->paginate(10);

        $today = Carbon::today();
        $stats = [
            'today'    => RendezVous::whereDate('scheduled_at', $today)->count(),
            'upcoming' => RendezVous::where('scheduled_at', '>', now())->count(),
            'pending'  => RendezVous::where('status', 'pending')->count(),
            'canceled' => RendezVous::where('status', 'canceled')->count(),
        ];

        return view('rendezvous.tableau_bord', compact('rendezvous', 'stats'));
    }

    // === AJOUT : page "Prendre un rendez-vous"
    public function create(Request $request)
    {
        // Pré-sélection d’un médecin via ?doctor=ID (facultatif)
        $prefillDoctor = (int) $request->query('doctor');

        // Liste des médecins pour le <select>
        $doctors = Doctor::query()
            ->select('id', 'name') // adapte si ton champ d’affichage est différent
            ->orderBy('name')
            ->get()
            ->map(fn($d) => ['id' => $d->id, 'label' => $d->name]);

        return view('rendezvous.create', compact('doctors', 'prefillDoctor'));
    }

    // === AJOUT : enregistrement du RDV
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id'    => ['required','exists:doctors,id'],
            'scheduled_at' => ['required','date','after:now'],
            'reason'       => ['nullable','string','max:1000'],
            // Si tu as ces champs côté formulaire (sinon adapte selon Auth::user())
            'patient_name'  => ['nullable','string','max:255'],
            'patient_phone' => ['nullable','string','max:30'],
        ]);

        // (Optionnel) Vérifier qu’il n’y a pas de chevauchement pour ce médecin
        $exists = RendezVous::where('doctor_id', $validated['doctor_id'])
            ->where('status', '!=', 'canceled')
            ->whereBetween('scheduled_at', [
                Carbon::parse($validated['scheduled_at'])->subMinutes(29),
                Carbon::parse($validated['scheduled_at'])->addMinutes(29),
            ])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['scheduled_at' => 'Ce créneau est déjà pris pour ce médecin.'])
                ->withInput();
        }

        // Construire les données à sauvegarder
        $data = [
            'doctor_id'    => $validated['doctor_id'],
            'scheduled_at' => Carbon::parse($validated['scheduled_at']),
            'reason'       => $validated['reason'] ?? null,
            'status'       => 'pending', // par défaut
        ];

        // Si tu as un système d’authentification patient :
        if (auth()->check()) {
            $data['patient_id']   = auth()->id();
            $data['patient_name'] = auth()->user()->name ?? ($validated['patient_name'] ?? null);
        } else {
            // Sinon, récupère depuis le formulaire si tu les envoies
            $data['patient_name']  = $validated['patient_name']  ?? null;
            $data['patient_phone'] = $validated['patient_phone'] ?? null;
        }

        RendezVous::create($data);

        return redirect()->route('rendezvous.index')
            ->with('status', 'Votre rendez-vous a été planifié.');
    }
}
