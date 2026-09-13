<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dueno = Auth::user()->load(['mascotas.citas', 'mascotas.historiasClinicas']);

        $mascotas = $dueno->mascotas;
        $totalMascotas = $mascotas->count();

        $citasProximas = $mascotas
            ->flatMap(fn ($mascota) => $mascota->citas->map(fn ($cita) => tap($cita, fn ($c) => $c->setRelation('mascota', $mascota))))
            ->filter(fn ($cita) => $cita->fecha_cita >= now())
            ->sortBy('fecha_cita')
            ->values();

        $recordatoriosVacunas = $mascotas
            ->flatMap(fn ($mascota) => $mascota->historiasClinicas->map(fn ($h) => tap($h, fn ($x) => $x->setRelation('mascota', $mascota))))
            ->filter(fn ($h) => ! empty($h->vacuna_recomendada))
            ->sortByDesc('fecha_registro')
            ->values();

        return view('dashboard-cliente', [
            'dueno' => $dueno,
            'totalMascotas' => $totalMascotas,
            'citasPendientes' => $citasProximas->count(),
            'vacunasProximas' => $recordatoriosVacunas->count(),
            'proximasCitas' => $citasProximas->take(5),
            'recordatorios' => $recordatoriosVacunas->take(5),
        ]);
    }
}
