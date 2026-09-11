<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->increments('id_mascota');
            $table->string('nombre_mascota', 45);
            $table->string('edad_mascota', 45);
            $table->string('peso_mascota', 45);
            $table->unsignedInteger('id_tipo_mascota');

            $table->foreign('id_tipo_mascota', 'id_tipo_mascota')
                ->references('id_tipo_mascota')->on('tipos_de_mascotas');
        });
    }

    public function down(): void
    {
        Schema::table('mascotas', function (Blueprint $table) {
            $table->dropForeign('id_tipo_mascota');
        });
        Schema::dropIfExists('mascotas');
    }
};
