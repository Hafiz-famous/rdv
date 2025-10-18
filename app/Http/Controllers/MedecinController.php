<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialty;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function index(Request $request)
    {
        $q = User::where('role','medecin')->with('specialties');

        if ($request->filled('specialty')) {
            $q->whereHas('specialties', function($qq) use ($request){
                $qq->where('slug', $request->specialty);
            });
        }

        $medecins = $q->paginate(12);
        $specialties = Specialty::orderBy('name')->get();

        return view('medecins.index', compact('medecins','specialties'));
    }

    public function show(User $medecin)
    {
        abort_unless($medecin->role === 'medecin', 404);
        $medecin->load('specialties','doctorProfile');
        return view('medecins.show', compact('medecin'));
    }
}
