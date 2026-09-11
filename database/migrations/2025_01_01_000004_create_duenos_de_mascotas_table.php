<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dueños_de_mascotas', function (Blueprint $table) {
            // Nota: MySQL no permite AUTO_INCREMENT en una llave primaria
            // compuesta, así que id_dueño queda como PK simple y se agrega
            // un índice único compuesto para preservar la misma restricción
            // del script original (referenciada por asignacion_cita).
            $table->increments('id_dueño');
            $table->string('num_contacto_dueños', 15)->unique();
            $table->string('email', 50)->unique();
            $table->string('nombre_dueños', 60);
            $table->string('apellido_dueños', 45);
            $table->string('num_documento', 15)->unique();
            $table->unsignedInteger('tipos_de_documento_id_tipo_documento');
            $table->unsignedInteger('mascotas_id_mascota');

            $table->unique(['id_dueño', 'mascotas_id_mascota'], 'ux_dueno_mascota');

            $table->foreign('tipos_de_documento_id_tipo_documento', 'fk_duenos_tipos_documento')
                ->references('id_tipo_documento')->on('tipos_de_documento');

            $table->foreign('mascotas_id_mascota', 'fk_duenos_mascotas1')
                ->references('id_mascota')->on('mascotas');
        });
    }

    public function down(): void
    {
        Schema::table('dueños_de_mascotas', function (Blueprint $table) {
            $table->dropForeign('fk_duenos_tipos_documento');
            $table->dropForeign('fk_duenos_mascotas1');
        });
        Schema::dropIfExists('dueños_de_mascotas');
    }
};
