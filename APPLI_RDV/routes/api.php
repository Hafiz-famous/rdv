<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Convention :
| - Toutes les routes sous /api/v1
| - Réponses JSON cohérentes
| - Auth avec Sanctum pour les routes protégées
| - Limitation de débit (throttle) pour éviter l’abus
*/

Route::prefix('v1')->group(function () {

    // --- Santé de l’API / ping (public)
    Route::get('health', fn () => response()->json([
        'ok' => true,
        'app' => config('app.name'),
        'version' => 'v1',
        'time' => now()->toISOString(),
    ]));

    // --- Auth (public)
    Route::prefix('auth')->middleware('throttle:20,1')->group(function () {
        Route::post('register', [AuthController::class, 'register']);   // Patient par défaut (à adapter)
        Route::post('login',    [AuthController::class, 'login']);
        Route::post('forgot',   [AuthController::class, 'forgotPassword'])->name('api.password.forgot'); // optionnel
    });

    // --- Catalogue public
    Route::get('doctors',      [DoctorController::class, 'index']);      // ?q=nom&specialty=slug&city=...
    Route::get('doctors/{id}', [DoctorController::class, 'show']);
    Route::get('specialties',  [SpecialtyController::class, 'index']);

    // --- Routes protégées (Sanctum)
    Route::middleware(['auth:sanctum'])->group(function () {

        // Infos du user connecté
        Route::get('me', fn (Request $request) => response()->json([
            'ok' => true,
            'data' => $request->user(),
        ]));

        // Déconnexion
        Route::post('auth/logout', [AuthController::class, 'logout']);

        // Rendez-vous (CRUD limité)
        Route::apiResource('appointments', AppointmentController::class)
            ->only(['index', 'store', 'show', 'update', 'destroy'])
            ->middleware('throttle:60,1'); // 60 req/min

        // Exemple : mes rendez-vous à venir
        Route::get('me/appointments/upcoming', [AppointmentController::class, 'upcoming']);
    });

    // Fallback JSON propre si route inconnue
    Route::fallback(function () {
        return response()->json([
            'ok' => false,
            'error' => [
                'code' => 'ROUTE_NOT_FOUND',
                'message' => 'Ressource introuvable.',
            ],
        ], 404);
    });
});
