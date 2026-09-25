<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MascotaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_mascota,
            'nombre' => $this->nombre_mascota,
            'tipo_mascota' => $this->whenLoaded('tipoMascota', fn () => $this->tipoMascota?->nombre_tipo_mascota),
            'raza' => $this->whenLoaded('tipoMascota', fn () => $this->tipoMascota?->nombre_raza),
            'id_tipo_mascota' => $this->id_tipo_mascota,
            'edad' => $this->edad_mascota,
            'peso' => $this->peso_mascota,
            'color' => $this->color_mascota,
            'fecha_nacimiento' => $this->fecha_nacimiento?->format('Y-m-d'),
            'observaciones' => $this->observaciones,
            'id_dueno' => $this->id_dueno,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
