<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipos_de_documento';
    protected $primaryKey = 'id_tipo_documento';

    protected $fillable = ['nombre_tipo_documento'];

    public function duenos()
    {
        return $this->hasMany(Dueno::class, 'tipo_documento_id', 'id_tipo_documento');
    }
}
