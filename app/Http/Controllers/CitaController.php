<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Veterinario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CitaController extends Controller
{
    public function index()
    {
        $idsMascotas = Auth::user()->mascotas()->pluck('id_mascota');

        $citas = Cita::with(['mascota', 'veterinarios'])
            ->whereIn('id_mascota', $idsMascotas)
            ->orderBy('fecha_cita')
            ->get();

        return view('citas', compact('citas'));
    }

    public function create()
    {
        $mascotas = Auth::user()->mascotas()->get();
        $veterinarios = Veterinario::orderBy('nombre_veterinario')->get();

        return view('agendar-citas', compact('mascotas', 'veterinarios'));
    }

    public function store(Request $request)
    {
        $idsMascotas = Auth::user()->mascotas()->pluck('id_mascota')->all();

        $validator = Validator::make($request->all(), [
            'id_mascota' => ['required', Rule::in($idsMascotas)],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', 'date_format:H:i'],
            'categoria' => ['required', 'string', 'max:45'],
            'id_veterinario' => ['nullable', 'exists:veterinarios,id_veterinario'],
            'descripcion' => ['nullable', 'string'],
        ]);

        // Validación cruzada: ¿el horario elegido ya está ocupado?
        // Va después de las reglas básicas porque necesita fecha + hora
        // ya válidas, y depende de consultar la base de datos.
        $validator->after(function ($validator) use ($request) {
            if (! $request->filled('fecha') || ! $request->filled('hora')) {
                return; // "required" ya reportó el problema
            }

            $fechaHora = Carbon::parse("{$request->fecha} {$request->hora}")->format('Y-m-d H:i:00');

            // ¿La mascota ya tiene una cita a esa misma fecha y hora?
            $mascotaOcupada = Cita::where('id_mascota', $request->id_mascota)
                ->where('fecha_cita', $fechaHora)
                ->exists();

            if ($mascotaOcupada) {
                $validator->errors()->add('hora', 'Esta mascota ya tiene una cita agendada a esa fecha y hora.');

                return;
            }

            // ¿El veterinario elegido ya tiene una cita a esa misma fecha y hora?
            if ($request->filled('id_veterinario')) {
                $veterinarioOcupado = Cita::where('fecha_cita', $fechaHora)
                    ->whereHas('veterinarios', function ($query) use ($request) {
                        $query->where('veterinarios.id_veterinario', $request->id_veterinario);
                    })
                    ->exists();

                if ($veterinarioOcupado) {
                    $validator->errors()->add(
                        'hora',
                        'Ese veterinario ya tiene una cita agendada a esa fecha y hora. Elige otro horario o deja "Según disponibilidad".'
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

        return redirect()->route('citas.index')->with('status', 'Cita agendada correctamente.');
    }
}
