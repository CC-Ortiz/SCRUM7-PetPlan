<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipos_de_documento';
    protected $primaryKey = 'id_tipo_documento';
    public $timestamps = false;

    protected $fillable = ['nombre_tipo_documento'];

    public function duenos()
    {
        return $this->hasMany(DuenoMascota::class, 'tipos_de_documento_id_tipo_documento');
    }
}
