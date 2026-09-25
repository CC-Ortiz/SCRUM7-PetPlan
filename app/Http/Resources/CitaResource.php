<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_citas,
            'fecha_cita' => $this->fecha_cita,
            'categoria' => $this->categoria,
            'descripcion' => $this->descripcion,
            'confirmada' => (bool) $this->confirmacion,
            'id_mascota' => $this->id_mascota,
            'mascota' => new MascotaResource($this->whenLoaded('mascota')),
            'veterinarios' => VeterinarioResource::collection($this->whenLoaded('veterinarios')),
            'created_at' => $this->created_at,
        ];
    }
}
