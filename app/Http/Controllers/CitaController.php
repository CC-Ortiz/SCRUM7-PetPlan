<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $datos = $request->validate([
            'id_mascota' => ['required', Rule::in($idsMascotas)],
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            'categoria' => ['required', 'string', 'max:45'],
            'id_veterinario' => ['nullable', 'exists:veterinarios,id_veterinario'],
            'descripcion' => ['nullable', 'string'],
        ]);

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
