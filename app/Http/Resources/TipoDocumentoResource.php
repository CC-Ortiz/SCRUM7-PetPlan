<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoDocumentoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_tipo_documento,
            'nombre_tipo_documento' => $this->nombre_tipo_documento,
        ];
    }
}
