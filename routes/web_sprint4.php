<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentAdminController;

// Espace médecin : gérer les RDV (confirmer/annuler)
Route::prefix('medecin')->middleware(['auth','can:access-medecin'])->group(function () {
    Route::get('/rendez-vous', [AppointmentAdminController::class,'index'])->name('medecin.rdv.index');
    Route::post('/rendez-vous/{appointment}/confirmer', [AppointmentAdminController::class,'confirm'])->name('medecin.rdv.confirm');
    Route::post('/rendez-vous/{appointment}/annuler', [AppointmentAdminController::class,'decline'])->name('medecin.rdv.decline');
});
