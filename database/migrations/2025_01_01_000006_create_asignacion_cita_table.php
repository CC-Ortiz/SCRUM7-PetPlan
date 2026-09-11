<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignacion_cita', function (Blueprint $table) {
            $table->unsignedInteger('dueños_de_mascotas_id_dueño');
            $table->unsignedInteger('dueños_de_mascotas_mascotas_id_mascota');
            $table->unsignedInteger('citas_id_citas');

            $table->primary(
                ['dueños_de_mascotas_id_dueño', 'dueños_de_mascotas_mascotas_id_mascota', 'citas_id_citas'],
                'pk_asignacion_cita'
            );

            $table->foreign(
                ['dueños_de_mascotas_id_dueño', 'dueños_de_mascotas_mascotas_id_mascota'],
                'fk_asignacion_cita_duenos1'
            )->references(['id_dueño', 'mascotas_id_mascota'])->on('dueños_de_mascotas');

            $table->foreign('citas_id_citas', 'fk_asignacion_cita_citas1')
                ->references('id_citas')->on('citas');
        });
    }

    public function down(): void
    {
        Schema::table('asignacion_cita', function (Blueprint $table) {
            $table->dropForeign('fk_asignacion_cita_duenos1');
            $table->dropForeign('fk_asignacion_cita_citas1');
        });
        Schema::dropIfExists('asignacion_cita');
    }
};
