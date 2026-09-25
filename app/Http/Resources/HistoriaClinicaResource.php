<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoriaClinicaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_historia_clinica,
            'id_mascota' => $this->id_mascota,
            'mascota' => new MascotaResource($this->whenLoaded('mascota')),
            'diagnostico' => $this->diagnostico,
            'tratamiento' => $this->tratamiento,
            'vacuna_recomendada' => $this->vacuna_recomendada,
            'fecha_registro' => $this->fecha_registro?->format('Y-m-d'),
            'historia_clinica' => $this->historia_clinica,
            'veterinarios' => VeterinarioResource::collection($this->whenLoaded('veterinarios')),
            'created_at' => $this->created_at,
        ];
    }
}
