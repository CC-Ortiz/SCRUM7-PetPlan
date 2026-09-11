<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';
    protected $primaryKey = 'id_mascota';
    public $timestamps = false;

    protected $fillable = ['nombre_mascota', 'edad_mascota', 'peso_mascota', 'id_tipo_mascota'];

    public function tipoMascota()
    {
        return $this->belongsTo(TipoMascota::class, 'id_tipo_mascota');
    }

    public function historiaClinica()
    {
        return $this->hasOne(HistoriaClinicaMascota::class, 'id_mascota');
    }
}
