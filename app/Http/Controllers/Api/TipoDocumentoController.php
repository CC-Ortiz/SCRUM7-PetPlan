<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipoDocumentoResource;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
    public function index()
    {
        return TipoDocumentoResource::collection(
            TipoDocumento::orderBy('nombre_tipo_documento')->get()
        );
    }
}
