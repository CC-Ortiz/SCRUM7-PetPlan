<?php

namespace App\Http\Controllers\Api\Veterinario;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitaResource;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $citas = $request->user()->citas()
            ->with('mascota.dueno')
            ->orderBy('fecha_cita')
            ->get();

        return CitaResource::collection($citas);
    }

    public function show(Request $request, Cita $cita)
    {
        $this->autorizar($request, $cita);

        return new CitaResource($cita->load('mascota.dueno'));
    }

    public function aceptar(Request $request, Cita $cita)
    {
        $this->autorizar($request, $cita);

        $cita->update(['confirmacion' => true]);

        return new CitaResource($cita->fresh(['mascota', 'veterinarios']));
    }

    private function autorizar(Request $request, Cita $cita): void
    {
        $veterinario = $request->user();

        abort_unless(
            $cita->veterinarios()->where('veterinarios.id_veterinario', $veterinario->id_veterinario)->exists(),
            403,
            'No tienes permiso para gestionar esta cita.'
        );
    }
}
