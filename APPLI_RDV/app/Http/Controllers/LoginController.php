<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Affiche le formulaire
    public function showLoginForm(Request $request)
    {
        // récupère ?role=patient|medecin|admin, défaut = patient
        $role = $request->query('role', 'patient');

        // passe le rôle à la vue pour afficher le bon libellé/formulaire
        return view('login_blade', compact('role'));
        // si ta vue est resources/views/auth/login.blade.php, remplace par view('auth.login', compact('role'));
    }

    // Traitement du login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirections vers des routes qui EXISTENT réellement
            if ($user->role === 'patient') {
                return redirect()->route('patient.dashboard');
            } elseif ($user->role === 'medecin') {
                // tu n'as pas 'medecin.dashboard' mais bien 'medecin.rendezvous'
                return redirect()->route('medecin.rendezvous');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                // rôle inconnu : on renvoie quelque part de sûr
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ])->withInput(); // garde l’email saisi
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
