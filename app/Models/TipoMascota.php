<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMascota extends Model
{
    protected $table = 'tipos_de_mascotas';
    protected $primaryKey = 'id_tipo_mascota';

    protected $fillable = ['nombre_tipo_mascota', 'nombre_raza'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'id_tipo_mascota', 'id_tipo_mascota');
    }
}
