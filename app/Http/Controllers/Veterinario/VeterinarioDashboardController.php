<?php

namespace App\Http\Controllers\Veterinario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VeterinarioDashboardController extends Controller
{
    public function index()
    {
        $veterinario = Auth::guard('veterinario')->user();

        $citas = $veterinario->citas()
            ->with('mascota.dueno')
            ->orderBy('fecha_cita')
            ->get();

        $citasPorConfirmar = $citas->where('confirmacion', false)->values();

        $citasConfirmadas = $citas->where('confirmacion', true)->values();

        return view('veterinario.dashboard', [
            'veterinario' => $veterinario,
            'citasPorConfirmar' => $citasPorConfirmar,
            'citasConfirmadas' => $citasConfirmadas,
        ]);
    }
}
