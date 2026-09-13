<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';
    protected $primaryKey = 'id_mascota';

    protected $fillable = [
        'nombre_mascota',
        'edad_mascota',
        'peso_mascota',
        'color_mascota',
        'fecha_nacimiento',
        'observaciones',
        'id_tipo_mascota',
        'id_dueno',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
        ];
    }

    // La FK vive aquí: cada mascota pertenece a un único dueño.
    public function dueno()
    {
        return $this->belongsTo(Dueno::class, 'id_dueno', 'id_dueno');
    }

    public function tipoMascota()
    {
        return $this->belongsTo(TipoMascota::class, 'id_tipo_mascota', 'id_tipo_mascota');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_mascota', 'id_mascota');
    }

    public function historiasClinicas()
    {
        return $this->hasMany(HistoriaClinica::class, 'id_mascota', 'id_mascota');
    }
}
