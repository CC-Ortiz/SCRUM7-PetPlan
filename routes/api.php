<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\HistoriaClinicaController;
use App\Http\Controllers\Api\MascotaController;
use App\Http\Controllers\Api\TipoDocumentoController;
use App\Http\Controllers\Api\TipoMascotaController;
use App\Http\Controllers\Api\VacunaController;
use App\Http\Controllers\Api\Veterinario\CitaController as VeterinarioCitaController;
use App\Http\Controllers\Api\Veterinario\HistoriaClinicaController as VeterinarioHistoriaClinicaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API PetPlan
|--------------------------------------------------------------------------
| Autenticación por Bearer Token (Laravel Sanctum). Cada respuesta
| protegida requiere el header:
|   Authorization: Bearer {token}
*/

// Datos de referencia (públicos, útiles para formularios de registro/mascotas)
Route::get('/tipos-documento', [TipoDocumentoController::class, 'index']);
Route::get('/tipos-mascota', [TipoMascotaController::class, 'index']);

// Autenticación
Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/login', [AuthController::class, 'login']);

// Accesibles para cualquier usuario autenticado (dueño o veterinario)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Panel del dueño de mascota
Route::middleware(['auth:sanctum', 'ability:dueno'])->group(function () {
    Route::apiResource('mascotas', MascotaController::class);

    Route::get('/citas', [CitaController::class, 'index']);
    Route::post('/citas', [CitaController::class, 'store']);
    Route::get('/citas/{cita}', [CitaController::class, 'show']);

    Route::get('/historial', [HistoriaClinicaController::class, 'index']);
    Route::get('/historial/{historiaClinica}', [HistoriaClinicaController::class, 'show']);

    Route::get('/vacunas', [VacunaController::class, 'index']);
});

// Panel del veterinario
Route::middleware(['auth:sanctum', 'ability:veterinario'])->prefix('veterinario')->name('api.veterinario.')->group(function () {
    Route::get('/citas', [VeterinarioCitaController::class, 'index']);
    Route::get('/citas/{cita}', [VeterinarioCitaController::class, 'show']);
    Route::post('/citas/{cita}/aceptar', [VeterinarioCitaController::class, 'aceptar']);

    Route::post('/citas/{cita}/historia', [VeterinarioHistoriaClinicaController::class, 'store']);
});
