<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\RendezVousController;

Route::get('/medecins', [MedecinController::class, 'index'])->name('medecins.index');
Route::get('/medecins/{medecin}', [MedecinController::class, 'show'])->name('medecins.show');

Route::middleware(['auth','can:access-patient'])->group(function(){
    Route::get('/rdv/{medecin}/nouveau', [RendezVousController::class,'create'])->name('rdv.create');
    Route::post('/rdv/{medecin}', [RendezVousController::class,'store'])->name('rdv.store');
    Route::post('/rdv/{appointment}/annuler', [RendezVousController::class,'cancel'])->name('rdv.cancel');
});
