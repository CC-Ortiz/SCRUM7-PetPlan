<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\Veterinario\CitaVeterinarioController;
use App\Http\Controllers\Veterinario\HistoriaClinicaVeterinarioController;
use App\Http\Controllers\Veterinario\VeterinarioDashboardController;
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', function () {
    return view('index');
})->name('inicio');

Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
Route::post('/registro', [AuthController::class, 'registro'])->name('registro.store');

// Login unificado: el mismo formulario detecta si es un dueño o un veterinario.
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Panel del dueño de mascota
Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascotas.index');
    Route::get('/mascotas/nueva', [MascotaController::class, 'create'])->name('mascotas.create');
    Route::post('/mascotas', [MascotaController::class, 'store'])->name('mascotas.store');

    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/agendar', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

    Route::get('/vacunas', [VacunaController::class, 'index'])->name('vacunas.index');

    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
});

// Panel del veterinario
Route::middleware('auth:veterinario')->prefix('veterinario')->name('veterinario.')->group(function () {
    Route::get('/', [VeterinarioDashboardController::class, 'index'])->name('dashboard');

    Route::post('/citas/{cita}/aceptar', [CitaVeterinarioController::class, 'aceptar'])->name('citas.aceptar');

    Route::get('/citas/{cita}/historia', [HistoriaClinicaVeterinarioController::class, 'create'])->name('historias.create');
    Route::post('/citas/{cita}/historia', [HistoriaClinicaVeterinarioController::class, 'store'])->name('historias.store');
});
