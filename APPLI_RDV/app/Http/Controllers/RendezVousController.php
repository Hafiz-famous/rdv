// app/Http/Controllers/RendezVousController.php

namespace App\Http\Controllers;

use App\Models\RendezVous;
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
}
