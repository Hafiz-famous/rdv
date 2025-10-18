<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\AppointmentController;

Route::get('/doctors', [DoctorController::class,'index']);
Route::get('/doctors/{id}/availability', [DoctorController::class,'availability']);
Route::post('/appointments', [AppointmentController::class,'store']);
Route::get('/my/appointments', [AppointmentController::class,'mine']);
Route::delete('/appointments/{id}', [AppointmentController::class,'destroy']);
