<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('edicion_historia_clinica', function (Blueprint $table) {
            $table->unsignedInteger('historia_clinica_mascota_id_historia_clinica');
            $table->unsignedInteger('veterinarios_id_veterinario');

            $table->primary(
                ['historia_clinica_mascota_id_historia_clinica', 'veterinarios_id_veterinario'],
                'pk_edicion_historia_clinica'
            );

            $table->foreign('historia_clinica_mascota_id_historia_clinica', 'fk_edicion_historia1')
                ->references('id_historia_clinica')->on('historia_clinica_mascota');

            $table->foreign('veterinarios_id_veterinario', 'fk_edicion_veterinarios1')
                ->references('id_veterinario')->on('veterinarios');
        });
    }

    public function down(): void
    {
        Schema::table('edicion_historia_clinica', function (Blueprint $table) {
            $table->dropForeign('fk_edicion_historia1');
            $table->dropForeign('fk_edicion_veterinarios1');
        });
        Schema::dropIfExists('edicion_historia_clinica');
    }
};
