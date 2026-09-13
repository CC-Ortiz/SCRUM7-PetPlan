<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\HistoriaClinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriaClinicaVeterinarioController extends Controller
{
    public function create(Cita $cita)
    {
        $this->autorizarAcceso($cita);

        $cita->load('mascota.dueno');

        return view('veterinario.historia-form', compact('cita'));
    }

    public function store(Request $request, Cita $cita)
    {
        $this->autorizarAcceso($cita);

        $datos = $request->validate([
            'diagnostico' => ['nullable', 'string', 'max:255'],
            'tratamiento' => ['nullable', 'string', 'max:255'],
            'vacuna_recomendada' => ['nullable', 'string', 'max:100'],
            'historia_clinica' => ['required', 'string'],
        ]);

        $veterinario = Auth::guard('veterinario')->user();

        $historia = HistoriaClinica::create([
            'id_mascota' => $cita->id_mascota,
            'diagnostico' => $datos['diagnostico'] ?? null,
            'tratamiento' => $datos['tratamiento'] ?? null,
            'vacuna_recomendada' => $datos['vacuna_recomendada'] ?? null,
            'fecha_registro' => now()->toDateString(),
            'historia_clinica' => $datos['historia_clinica'],
        ]);

        $historia->veterinarios()->attach($veterinario->id_veterinario);

        return redirect()
            ->route('veterinario.dashboard')
            ->with('status', 'Historia clínica registrada correctamente.');
    }

    /**
     * Solo el veterinario asignado a la cita puede escribir su historia clínica,
     * y solo una vez que la cita ya fue confirmada.
     */
    private function autorizarAcceso(Cita $cita): void
    {
        $veterinario = Auth::guard('veterinario')->user();

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
    }
}
