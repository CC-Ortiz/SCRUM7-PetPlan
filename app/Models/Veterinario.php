<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    protected $table = 'veterinarios';
    protected $primaryKey = 'id_veterinario';
    public $timestamps = false;

    protected $fillable = [
        'nombre_veterinario',
        'apellido_veterinario',
        'num_documento_vet',
        'num_tarjetaprofesional',
        'email_veterinario',
        'num_contacto_veterinario',
    ];

    public function citas()
    {
        return $this->belongsToMany(
            Cita::class,
            'asignacion_veterinario',
            'veterinarios_id_veterinario',
            'citas_id_citas'
        );
    }

    public function historiasClinicas()
    {
        return $this->belongsToMany(
            HistoriaClinicaMascota::class,
            'edicion_historia_clinica',
            'veterinarios_id_veterinario',
            'historia_clinica_mascota_id_historia_clinica'
        );
    }
}
