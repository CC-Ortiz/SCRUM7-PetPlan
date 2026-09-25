<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MascotaResource;
use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index(Request $request)
    {
        $mascotas = $request->user()->mascotas()->with('tipoMascota')->latest()->get();

        return MascotaResource::collection($mascotas);
    }

    public function store(Request $request)
    {
        $datos = $this->validarDatos($request);
        $datos['id_dueno'] = $request->user()->id_dueno;

        $mascota = Mascota::create($datos);

        return (new MascotaResource($mascota->load('tipoMascota')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Request $request, Mascota $mascota)
    {
        $this->autorizar($request, $mascota);

        return new MascotaResource($mascota->load('tipoMascota'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        $this->autorizar($request, $mascota);

        $mascota->update($this->validarDatos($request));

        return new MascotaResource($mascota->load('tipoMascota'));
    }

    public function destroy(Request $request, Mascota $mascota)
    {
        $this->autorizar($request, $mascota);

        $mascota->delete();

        return response()->json(['message' => 'Mascota eliminada correctamente.']);
    }

    private function validarDatos(Request $request): array
    {
        return $request->validate([
            'nombre_mascota' => ['required', 'string', 'max:45'],
            'id_tipo_mascota' => ['required', 'exists:tipos_de_mascotas,id_tipo_mascota'],
            'edad_mascota' => ['required', 'string', 'max:45'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'peso_mascota' => ['required', 'string', 'max:45'],
            'color_mascota' => ['nullable', 'string', 'max:45'],
            'observaciones' => ['nullable', 'string'],
        ]);
    }

    private function autorizar(Request $request, Mascota $mascota): void
    {
        abort_unless(
            $mascota->id_dueno === $request->user()->id_dueno,
            403,
            'No tienes permiso para acceder a esta mascota.'
        );
    }
}
