<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitaResource;
use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $idsMascotas = $request->user()->mascotas()->pluck('id_mascota');

        $citas = Cita::with(['mascota', 'veterinarios'])
            ->whereIn('id_mascota', $idsMascotas)
            ->orderBy('fecha_cita')
            ->get();

        return CitaResource::collection($citas);
    }

    public function store(Request $request)
    {
        $idsMascotas = $request->user()->mascotas()->pluck('id_mascota')->all();

        $validator = Validator::make($request->all(), [
            'id_mascota' => ['required', Rule::in($idsMascotas)],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', 'date_format:H:i'],
            'categoria' => ['required', 'string', 'max:45'],
            'id_veterinario' => ['nullable', 'exists:veterinarios,id_veterinario'],
            'descripcion' => ['nullable', 'string'],
        ]);

        // Validación cruzada: ¿el horario elegido ya está ocupado?
        $validator->after(function ($validator) use ($request) {
            if (! $request->filled('fecha') || ! $request->filled('hora')) {
                return; // "required" ya reportó el problema
            }

            $fechaHora = Carbon::parse("{$request->fecha} {$request->hora}")->format('Y-m-d H:i:00');

            $mascotaOcupada = Cita::where('id_mascota', $request->id_mascota)
                ->where('fecha_cita', $fechaHora)
                ->exists();

            if ($mascotaOcupada) {
                $validator->errors()->add('hora', 'Esta mascota ya tiene una cita agendada a esa fecha y hora.');

                return;
            }

            if ($request->filled('id_veterinario')) {
                $veterinarioOcupado = Cita::where('fecha_cita', $fechaHora)
                    ->whereHas('veterinarios', function ($query) use ($request) {
                        $query->where('veterinarios.id_veterinario', $request->id_veterinario);
                    })
                    ->exists();

                if ($veterinarioOcupado) {
                    $validator->errors()->add(
                        'hora',
                        'Ese veterinario ya tiene una cita agendada a esa fecha y hora. Elige otro horario o deja la asignación según disponibilidad.'
                    );
                }
            }
        });

        $datos = $validator->validate();

        $cita = Cita::create([
            'id_mascota' => $datos['id_mascota'],
            'fecha_cita' => $datos['fecha'].' '.$datos['hora'],
            'categoria' => $datos['categoria'],
            'descripcion' => $datos['descripcion'] ?? '',
            'confirmacion' => false,
        ]);

        if (! empty($datos['id_veterinario'])) {
            $cita->veterinarios()->attach($datos['id_veterinario']);
        }

        return (new CitaResource($cita->load(['mascota', 'veterinarios'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Request $request, Cita $cita)
    {
        $idsMascotas = $request->user()->mascotas()->pluck('id_mascota')->all();

        abort_unless(in_array($cita->id_mascota, $idsMascotas), 403, 'No tienes permiso para ver esta cita.');

        return new CitaResource($cita->load(['mascota', 'veterinarios']));
    }
}
