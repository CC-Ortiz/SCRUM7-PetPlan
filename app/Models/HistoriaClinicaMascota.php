<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinicaMascota extends Model
{
    protected $table = 'historia_clinica_mascota';
    protected $primaryKey = 'id_historia_clinica';
    public $timestamps = false;

    protected $fillable = ['id_mascota', 'id_dueño', 'historia_clinica'];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }

    public function dueno()
    {
        return $this->belongsTo(DuenoMascota::class, 'id_dueño');
    }

    public function veterinarios()
    {
        return $this->belongsToMany(
            Veterinario::class,
            'edicion_historia_clinica',
            'historia_clinica_mascota_id_historia_clinica',
            'veterinarios_id_veterinario'
        );
    }
}
