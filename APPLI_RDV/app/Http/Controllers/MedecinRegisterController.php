<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MedecinRegisterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => ['required','string','max:255'],
            'email'          => ['required','email','max:255', Rule::unique('users','email')],
            'password'       => ['required','string','min:8','confirmed'],
            'specialite'     => ['required','string','max:255'],
            'numero_ordre'   => ['nullable','string','max:255'],
            'cabinet'        => ['nullable','string','max:255'],
            'pays'           => ['nullable','string','max:120'],
            'ville'          => ['nullable','string','max:120'],
            'cgu'            => ['accepted'],
        ], [
            'email.unique'   => 'Cet email est déjà utilisé.',
            'password.min'   => 'Mot de passe : 8 caractères minimum.',
            'cgu.accepted'   => 'Vous devez accepter les conditions.',
        ]);

        // 1) Créer l'utilisateur avec le rôle "medecin"
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'medecin',
        ]);

        // 2) Profil médecin (facultatif mais propre)
        Doctor::create([
            'user_id'      => $user->id,
            'specialite'   => $data['specialite'],
            'numero_ordre' => $data['numero_ordre'] ?? null,
            'cabinet'      => $data['cabinet'] ?? null,
            'pays'         => $data['pays'] ?? null,
            'ville'        => $data['ville'] ?? null,
        ]);

        return redirect()->route('login', ['role' => 'medecin'])
                         ->with('success', 'Compte créé ! Vous pouvez vous connecter.');
    }
}
