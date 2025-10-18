<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Affiche le formulaire d'inscription patient
     */
    public function showForm()
    {
        return view('register_patient');
    }

    /**
     * Traite l'inscription du patient
     */
    public function register(Request $request)
    {
        // 1) Validation : on accepte soit "name", soit "first_name"+"last_name"
        $validated = $request->validate([
            'name'         => ['nullable','string','max:255'],   // facultatif si first/last envoyés
            'first_name'   => ['nullable','string','max:100'],
            'last_name'    => ['nullable','string','max:100'],
            'email'        => ['required','email', Rule::unique('users','email')],
            'password'     => ['required','string','min:6','confirmed'], // nécessite password_confirmation
        ], [
            // (messages personnalisés si tu veux)
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        // 2) Construire le nom final
        $finalName = $validated['name'] ?? trim(($validated['first_name'] ?? '').' '.($validated['last_name'] ?? ''));
        if ($finalName === '') {
            // Si rien n'a été fourni pour le nom, on renvoie une erreur claire
            return back()
                ->withErrors(['name' => 'Veuillez renseigner un nom ou bien prénom + nom.'])
                ->withInput();
        }

        // 3) Créer l'utilisateur
        $user = User::create([
            'name'     => $finalName,
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'patient', // Assure-toi que la colonne 'role' existe
        ]);

        // 4) (Optionnel) Connexion auto après inscription
        // Auth::login($user);

        // 5) Redirection + flash message (vers login par défaut)
        return redirect()
            ->route('login')
            ->with('success', 'Inscription réussie ! Vous pouvez vous connecter.');
    }
}
