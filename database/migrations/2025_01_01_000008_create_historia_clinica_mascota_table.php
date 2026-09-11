<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historia_clinica_mascota', function (Blueprint $table) {
            $table->increments('id_historia_clinica');
            $table->unsignedInteger('id_mascota')->unique();
            $table->unsignedInteger('id_dueño')->unique();
            $table->text('historia_clinica');

            $table->foreign('id_mascota', 'fk_historia_mascota')
                ->references('id_mascota')->on('mascotas');

            $table->foreign('id_dueño', 'fk_historia_dueno')
                ->references('id_dueño')->on('dueños_de_mascotas');
        });
    }

    public function down(): void
    {
        Schema::table('historia_clinica_mascota', function (Blueprint $table) {
            $table->dropForeign('fk_historia_mascota');
            $table->dropForeign('fk_historia_dueno');
        });
        Schema::dropIfExists('historia_clinica_mascota');
    }
};
