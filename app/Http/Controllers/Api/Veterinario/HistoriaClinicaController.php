<?php

namespace App\Http\Controllers\Api\Veterinario;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriaClinicaResource;
use App\Models\Cita;
use App\Models\HistoriaClinica;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function store(Request $request, Cita $cita)
    {
        $veterinario = $request->user();

        abort_unless(
            $cita->veterinarios()->where('veterinarios.id_veterinario', $veterinario->id_veterinario)->exists(),
            403,
            'No tienes permiso para gestionar esta cita.'
        );

        abort_unless(
            $cita->confirmacion,
            403,
            'Debes confirmar la cita antes de registrar la historia clínica.'
        );

        $datos = $request->validate([
            'diagnostico' => ['nullable', 'string', 'max:255'],
            'tratamiento' => ['nullable', 'string', 'max:255'],
            'vacuna_recomendada' => ['nullable', 'string', 'max:100'],
            'historia_clinica' => ['required', 'string'],
        ]);

        $historia = HistoriaClinica::create([
            'id_mascota' => $cita->id_mascota,
            'diagnostico' => $datos['diagnostico'] ?? null,
            'tratamiento' => $datos['tratamiento'] ?? null,
            'vacuna_recomendada' => $datos['vacuna_recomendada'] ?? null,
            'fecha_registro' => now()->toDateString(),
            'historia_clinica' => $datos['historia_clinica'],
        ]);

        $historia->veterinarios()->attach($veterinario->id_veterinario);

        return (new HistoriaClinicaResource($historia->load(['mascota', 'veterinarios'])))
            ->response()
            ->setStatusCode(201);
    }
}
