<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\RendezVousController;

// Médecin : gérer ses créneaux
Route::prefix('medecin')->middleware(['auth','can:access-medecin'])->group(function () {
    Route::get('/creneaux', [AvailabilityController::class,'index'])->name('medecin.slots.index');
    Route::post('/creneaux', [AvailabilityController::class,'store'])->name('medecin.slots.store');
    Route::delete('/creneaux/{slot}', [AvailabilityController::class,'destroy'])->name('medecin.slots.destroy');
});

// Public/patient : voir les créneaux d'un médecin spécifique
Route::get('/medecins/{medecin}/creneaux', [AvailabilityController::class,'listForDoctor'])->name('medecins.slots');

// Patient : réserver un créneau donné (transformé en RDV)
Route::post('/rdv/slot/{slot}', [RendezVousController::class,'bookFromSlot'])
    ->middleware(['auth','can:access-patient'])
    ->name('rdv.book.slot');
