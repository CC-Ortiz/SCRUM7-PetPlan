<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriaClinicaResource;
use App\Models\HistoriaClinica;
use Illuminate\Http\Request;

class VacunaController extends Controller
{
    public function index(Request $request)
    {
        $idsMascotas = $request->user()->mascotas()->pluck('id_mascota');

        $vacunas = HistoriaClinica::with('mascota')
            ->whereIn('id_mascota', $idsMascotas)
            ->whereNotNull('vacuna_recomendada')
            ->where('vacuna_recomendada', '!=', '')
            ->orderByDesc('fecha_registro')
            ->get();

        return HistoriaClinicaResource::collection($vacunas);
    }
}
