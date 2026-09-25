<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VeterinarioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_veterinario,
            'nombre' => $this->nombre_veterinario,
            'apellido' => $this->apellido_veterinario,
            'nombre_completo' => $this->nombreCompleto(),
            'email' => $this->email_veterinario,
            'num_contacto' => $this->num_contacto_veterinario,
            'num_documento' => $this->num_documento_vet,
            'num_tarjeta_profesional' => $this->num_tarjeta_profesional,
        ];
    }
}
