<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoMascotaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_tipo_mascota,
            'nombre_tipo_mascota' => $this->nombre_tipo_mascota,
            'nombre_raza' => $this->nombre_raza,
        ];
    }
}
