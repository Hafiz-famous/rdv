<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string'],
        ]);

        $remember = (bool) $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $role = Auth::user()->role ?? 'patient';
            return match ($role) {
                'admin'   => redirect()->route('admin.dashboard')->with('success','Bienvenue admin !'),
                'medecin' => redirect()->route('medecin.rendezvous')->with('success','Bienvenue docteur !'),
                default   => redirect()->route('patient.dashboard')->with('success','Connexion réussie !'),
            };
        }

        return back()->withErrors(['email' => 'Identifiants invalides.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Déconnecté.');
    }
}
