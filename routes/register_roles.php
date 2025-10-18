<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RoleRegisterController;

/*
|--------------------------------------------------------------------------
| Routes d'inscription par rôle
|--------------------------------------------------------------------------
| Inclus depuis routes/web.php via: require __DIR__.'/register_roles.php';
*/

Route::controller(RoleRegisterController::class)->group(function () {
    Route::get('/register/{role}', 'show')->name('register.show');
    Route::post('/register/{role}', 'store')->name('register.store');
});

// Dashboards protégés (exemples)
Route::middleware(['auth', 'role:patient'])->get('/patient', fn () => view('dash.patient'))->name('dashboard.patient');
Route::middleware(['auth', 'role:medecin'])->get('/medecin', fn () => view('dash.medecin'))->name('dashboard.medecin');
Route::middleware(['auth', 'role:infirmier'])->get('/infirmier', fn () => view('dash.infirmier'))->name('dashboard.infirmier');
Route::middleware(['auth', 'role:admin'])->get('/admin', fn () => view('dash.admin'))->name('dashboard.admin');
