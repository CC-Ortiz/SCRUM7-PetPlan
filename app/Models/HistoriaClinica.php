<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    protected $table = 'historias_clinicas';
    protected $primaryKey = 'id_historia_clinica';

    protected $fillable = [
        'id_mascota',
        'diagnostico',
        'tratamiento',
        'vacuna_recomendada',
        'fecha_registro',
        'historia_clinica',
    ];

    protected function casts(): array
    {
        return [
            'fecha_registro' => 'date',
        ];
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota', 'id_mascota');
    }

    public function veterinarios()
    {
        return $this->belongsToMany(
            Veterinario::class,
            'historia_veterinario',
            'id_historia_clinica',
            'id_veterinario'
        );
    }
}
