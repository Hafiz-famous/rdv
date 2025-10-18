<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RoleRegisterController;

Route::get('/register/patient',   [RoleRegisterController::class,'showPatientForm'])->name('register.patient.form');
Route::post('/register/patient',  [RoleRegisterController::class,'registerPatient'])->name('register.patient');

Route::get('/register/medecin',   [RoleRegisterController::class,'showDoctorForm'])->name('register.medecin.form');
Route::post('/register/medecin',  [RoleRegisterController::class,'registerDoctor'])->name('register.medecin');

Route::get('/register/infirmier', [RoleRegisterController::class,'showNurseForm'])->name('register.infirmier.form');
Route::post('/register/infirmier',[RoleRegisterController::class,'registerNurse'])->name('register.infirmier');

Route::get('/register/admin',     [RoleRegisterController::class,'showAdminForm'])->name('register.admin.form');
Route::post('/register/admin',    [RoleRegisterController::class,'registerAdmin'])->name('register.admin');

Route::view('/dashboard/patient',   'dashboards.patient')->name('dashboard.patient')->middleware(['auth']);
Route::view('/dashboard/medecin',   'dashboards.medecin')->name('dashboard.medecin')->middleware(['auth']);
Route::view('/dashboard/infirmier', 'dashboards.infirmier')->name('dashboard.infirmier')->middleware(['auth']);
Route::view('/dashboard/admin',     'dashboards.admin')->name('dashboard.admin')->middleware(['auth']);
