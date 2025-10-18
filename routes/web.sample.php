<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailabilityController;

Route::get('/', function () { return view('welcome'); })->name('home');

// Auth
Route::get('/register/patient', [PatientController::class, 'showForm'])->name('register.patient');
Route::post('/register/patient', [PatientController::class, 'register'])->name('register.patient.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Patient
Route::prefix('patient')->middleware(['auth','can:access-patient'])->group(function () {
    Route::get('/dashboard', function(){ return view('patient.dashboard'); })->name('patient.dashboard');
    Route::get('/profil', function(){ return view('patient.profile'); })->name('patient.profile');
    Route::get('/dossier', function(){ return view('patient.dossier'); })->name('patient.dossier');
    Route::get('/rdv', [AppointmentController::class,'myAppointments'])->name('patient.rdv');
    Route::get('/rdv/medecin/{doctor}', [AppointmentController::class,'show'])->name('rdv.show');
    Route::post('/rdv/medecin/{doctor}', [AppointmentController::class,'book'])->name('rdv.book');
});

// Médecin
Route::prefix('medecin')->middleware(['auth','can:access-medecin'])->group(function () {
    Route::get('/rendez-vous', [AppointmentController::class,'doctorAppointments'])->name('medecin.rendezvous');
    Route::get('/disponibilites', [AvailabilityController::class,'index'])->name('medecin.avail');
    Route::post('/disponibilites', [AvailabilityController::class,'store'])->name('medecin.avail.store');
});

// Admin
Route::prefix('admin')->middleware(['auth','can:access-admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class,'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class,'createUser'])->name('admin.users.create');
    Route::get('/statistiques', [AdminController::class, 'rapport'])->name('admin.statistiques'); 
});

// RDV actions (médecin)
Route::post('/rdv/{appointment}/confirm', [AppointmentController::class,'confirm'])
  ->middleware(['auth','can:access-medecin'])->name('rdv.confirm');
Route::post('/rdv/{appointment}/cancel', [AppointmentController::class,'cancel'])
  ->middleware(['auth','can:access-medecin'])->name('rdv.cancel');
