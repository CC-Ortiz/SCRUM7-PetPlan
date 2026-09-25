<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriaClinicaResource;
use App\Models\HistoriaClinica;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller
{
    public function index(Request $request)
    {
        $idsMascotas = $request->user()->mascotas()->pluck('id_mascota');

        $historias = HistoriaClinica::with(['mascota', 'veterinarios'])
            ->whereIn('id_mascota', $idsMascotas)
            ->orderByDesc('fecha_registro')
            ->get();

        return HistoriaClinicaResource::collection($historias);
    }

    public function show(Request $request, HistoriaClinica $historiaClinica)
    {
        $idsMascotas = $request->user()->mascotas()->pluck('id_mascota')->all();

        abort_unless(
            in_array($historiaClinica->id_mascota, $idsMascotas),
            403,
            'No tienes permiso para ver esta historia clínica.'
        );

        return new HistoriaClinicaResource($historiaClinica->load(['mascota', 'veterinarios']));
    }
}
