<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'id_citas';
    public $timestamps = false;

    protected $fillable = ['fecha_cita', 'descripcion', 'confirmacion'];

    public function veterinarios()
    {
        return $this->belongsToMany(
            Veterinario::class,
            'asignacion_veterinario',
            'citas_id_citas',
            'veterinarios_id_veterinario'
        );
    }
}
