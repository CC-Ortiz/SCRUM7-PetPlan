<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dueno extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'duenos';
    protected $primaryKey = 'id_dueno';

    protected $fillable = [
        'num_contacto',
        'email',
        'nombre',
        'apellido',
        'num_documento',
        'tipo_documento_id',
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

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id_tipo_documento');
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'id_dueno', 'id_dueno');
    }

    public function nombreCompleto(): string
    {
        return trim("{$this->nombre} {$this->apellido}");
    }
}
