<?php

use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientProfileController; // +++ actions Profil Patient

// =====================================================
// 1) PAGES PUBLIQUES
// =====================================================

Route::view('/', 'welcome')->name('home');

/* Parcourir */
Route::view('/medecins', 'medecins.index')->name('medecins.index');
Route::view('/specialites', 'specialites.index')->name('specialites.index');
Route::get('/specialites/{slug}', fn ($slug) => view('specialites.show', ['specialite_slug' => $slug]))
    ->name('specialites.show');
Route::view('/centres-de-sante', 'centres-sante.index')->name('centres-sante.index');

/* Statiques */
Route::view('/aide', 'aide')->name('aide');
Route::view('/a-propos', 'apropos')->name('apropos');

/* Cabinet / Centre de santé */
Route::view('/inscrire-cabinet', 'cabinets.register')->name('cabinets.register.show');
// Route::post('/inscrire-cabinet', [CabinetController::class, 'register'])->name('cabinets.register.submit');
Route::view('/connexion-cabinet', 'auth.login-cabinet')->name('cabinets.login.show');

/* Placeholder : lien "Prendre RDV" (à brancher plus tard) */
// Route::get('/rendez-vous/nouveau', fn () => 'Formulaire RDV (à venir)')
//     ->name('rendezvous.create');


// =====================================================
// 2) AUTHENTIFICATION
// =====================================================

/* Inscription Patient */
Route::get('/register/patient', [PatientController::class, 'showForm'])->name('register.patient');
Route::post('/register/patient', [PatientController::class, 'register'])->name('register.patient.submit');

/* Login / Logout */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');         // ?role=patient|medecin|admin possible
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// =====================================================
// 3) TABLEAUX DE BORD (protégés)
// =====================================================

/* Patient */
Route::prefix('patient')->middleware(['auth', 'can:access-patient'])->group(function () {
    // redirection courte
    Route::redirect('/', '/patient/dashboard');

    // vues
    Route::view('/dashboard', 'patient.dashboard')->name('patient.dashboard');
    Route::view('/dossier',   'patient.dossier')->name('patient.dossier');
    Route::view('/profil',    'patient.profile')->name('patient.profile');

    // actions Profil (AJOUTÉES)
    Route::post('/profil/update',     [PatientProfileController::class, 'updateProfile'])->name('patient.profile.update');
    Route::post('/profil/avatar',     [PatientProfileController::class, 'updateAvatar'])->name('patient.avatar.update');
    Route::post('/profil/password',   [PatientProfileController::class, 'updatePassword'])->name('patient.password.update');
    Route::post('/preferences',       [PatientProfileController::class, 'updatePreferences'])->name('patient.preferences.update');
});

// routes/web.php
// routes/web.php
// use App\Http\Controllers\RendezVousController;

Route::middleware(['auth'])->group(function () {
    // URL FR que tu utilises actuellement
    Route::get('/rendez-vous/nouveau', [RendezVousController::class, 'create'])
        ->name('rendezvous.create');

    // Enregistrement du RDV
    Route::post('/rendezvous', [RendezVousController::class, 'store'])
        ->name('rendezvous.store');
});




/* Admin */
Route::prefix('admin')->middleware(['auth', 'can:access-admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class,'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class,'createUser'])->name('admin.users.create');
    Route::get('/statistiques', [AdminController::class, 'rapport'])->name('admin.statistiques');
});

/* Médecin (exemples) */
Route::prefix('medecin')->middleware(['auth', 'can:access-medecin'])->group(function () {
    Route::view('/rendez-vous', 'rendezvous.tableau_bord')->name('medecin.rendezvous');
    Route::view('/nouvelle-consultation', 'patients.nouvelle_consultation')->name('medecin.consultation');
});


// =====================================================
// 4) FALLBACK (404 simple facultatif)
// =====================================================

// Route::fallback(fn () => abort(404));
