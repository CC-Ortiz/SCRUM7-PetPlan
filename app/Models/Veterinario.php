<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Veterinario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'veterinarios';
    protected $primaryKey = 'id_veterinario';

    protected $fillable = [
        'nombre_veterinario',
        'apellido_veterinario',
        'num_documento_vet',
        'num_tarjeta_profesional',
        'email_veterinario',
        'num_contacto_veterinario',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }



    public function citas()
    {
        return $this->belongsToMany(
            Cita::class,
            'cita_veterinario',
            'id_veterinario',
            'id_citas'
        );
    }

    public function historiasClinicas()
    {
        return $this->belongsToMany(
            HistoriaClinica::class,
            'historia_veterinario',
            'id_veterinario',
            'id_historia_clinica'
        );
    }

    public function nombreCompleto(): string
    {
        return trim("{$this->nombre_veterinario} {$this->apellido_veterinario}");
    }
}
