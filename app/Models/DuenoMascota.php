<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuenoMascota extends Model
{
    protected $table = 'dueños_de_mascotas';
    protected $primaryKey = 'id_dueño';
    public $timestamps = false;

    protected $fillable = [
        'num_contacto_dueños',
        'email',
        'nombre_dueños',
        'apellido_dueños',
        'num_documento',
        'tipos_de_documento_id_tipo_documento',
        'mascotas_id_mascota',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipos_de_documento_id_tipo_documento');
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascotas_id_mascota');
    }

    public function historiaClinica()
    {
        return $this->hasOne(HistoriaClinicaMascota::class, 'id_dueño');
    }

    public function citas()
    {
        return $this->belongsToMany(
            Cita::class,
            'asignacion_cita',
            'dueños_de_mascotas_id_dueño',
            'citas_id_citas'
        );
    }
}
