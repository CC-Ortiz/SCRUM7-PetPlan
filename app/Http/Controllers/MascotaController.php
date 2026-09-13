<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\TipoMascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Auth::user()->mascotas()->with('tipoMascota')->latest()->get();

        return view('mascotas', compact('mascotas'));
    }

    public function create()
    {
        $tiposMascota = TipoMascota::orderBy('nombre_tipo_mascota')->get();

        return view('registrar-mascota', compact('tiposMascota'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre_mascota' => ['required', 'string', 'max:45'],
            'id_tipo_mascota' => ['required', 'exists:tipos_de_mascotas,id_tipo_mascota'],
            'edad_mascota' => ['required', 'string', 'max:45'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'peso_mascota' => ['required', 'string', 'max:45'],
            'color_mascota' => ['nullable', 'string', 'max:45'],
            'observaciones' => ['nullable', 'string'],
        ]);

        $datos['id_dueno'] = Auth::id();

        Mascota::create($datos);

        return redirect()->route('mascotas.index')->with('status', 'Mascota registrada correctamente.');
    }

    public function edit(Mascota $mascota)
    {
        // Seguridad: que solo el dueño pueda editar su propia mascota
        if ($mascota->id_dueno !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta mascota.');
        }

        $tiposMascota = TipoMascota::orderBy('nombre_tipo_mascota')->get();

        return view('editar-mascota', compact('mascota', 'tiposMascota'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        if ($mascota->id_dueno !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta mascota.');
        }

        $datos = $request->validate([
            'nombre_mascota' => ['required', 'string', 'max:45'],
            'id_tipo_mascota' => ['required', 'exists:tipos_de_mascotas,id_tipo_mascota'],
            'edad_mascota' => ['required', 'string', 'max:45'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'peso_mascota' => ['required', 'string', 'max:45'],
            'color_mascota' => ['nullable', 'string', 'max:45'],
            'observaciones' => ['nullable', 'string'],
        ]);

        $mascota->update($datos);

        return redirect()->route('mascotas.index')->with('status', 'Mascota actualizada correctamente.');
    }

    public function destroy(Mascota $mascota)
    {
        if ($mascota->id_dueno !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta mascota.');
        }

        $mascota->delete();

        return redirect()->route('mascotas.index')->with('status', 'Mascota eliminada correctamente.');
    }
}