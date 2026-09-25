<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipoMascotaResource;
use App\Models\TipoMascota;

class TipoMascotaController extends Controller
{
    public function index()
    {
        return TipoMascotaResource::collection(
            TipoMascota::orderBy('nombre_tipo_mascota')->get()
        );
    }
}
