<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DuenoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_dueno,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'nombre_completo' => $this->nombreCompleto(),
            'email' => $this->email,
            'num_contacto' => $this->num_contacto,
            'num_documento' => $this->num_documento,
            'tipo_documento' => $this->whenLoaded('tipoDocumento', fn () => $this->tipoDocumento?->nombre_tipo_documento),
            'created_at' => $this->created_at,
        ];
    }
}
