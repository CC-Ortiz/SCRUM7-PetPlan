<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignacion_veterinario', function (Blueprint $table) {
            $table->unsignedInteger('citas_id_citas');
            $table->unsignedInteger('veterinarios_id_veterinario');

            $table->primary(['citas_id_citas', 'veterinarios_id_veterinario'], 'pk_asignacion_veterinario');

            $table->foreign('citas_id_citas', 'fk_asig_vet_citas1')
                ->references('id_citas')->on('citas');

            $table->foreign('veterinarios_id_veterinario', 'fk_asig_vet_veterinarios1')
                ->references('id_veterinario')->on('veterinarios');
        });
    }

    public function down(): void
    {
        Schema::table('asignacion_veterinario', function (Blueprint $table) {
            $table->dropForeign('fk_asig_vet_citas1');
            $table->dropForeign('fk_asig_vet_veterinarios1');
        });
        Schema::dropIfExists('asignacion_veterinario');
    }
};
