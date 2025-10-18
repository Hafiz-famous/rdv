<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et si son rôle est admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Sinon redirige vers la page d'accueil ou login
        return redirect('/login')->with('error', 'Vous n\'avez pas accès à cette page.');
    }
}

// Fichier : app/Http/Middleware/CheckUserRole.php (ou isAdmin.php)

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // 1. Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Vérifie si le rôle de l'utilisateur correspond au rôle requis
        // (Assurez-vous que votre modèle User a une colonne 'role' ou 'profil')
        if (Auth::user()->role !== $role) {
            // Redirige vers la page d'accueil ou envoie une erreur 403
            return redirect('/dashboard')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}