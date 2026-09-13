<?php

namespace App\Http\Controllers;

use App\Models\HistoriaClinica;
use Illuminate\Support\Facades\Auth;

class VacunaController extends Controller
{
    public function index()
    {
        $idsMascotas = Auth::user()->mascotas()->pluck('id_mascota');

        $vacunas = HistoriaClinica::with('mascota')
            ->whereIn('id_mascota', $idsMascotas)
            ->whereNotNull('vacuna_recomendada')
            ->where('vacuna_recomendada', '!=', '')
            ->orderByDesc('fecha_registro')
            ->get();

        return view('vacunas', compact('vacunas'));
    }
}
