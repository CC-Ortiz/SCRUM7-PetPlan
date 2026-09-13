<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_de_mascotas', function (Blueprint $table) {
            $table->id('id_tipo_mascota');
            $table->string('nombre_tipo_mascota', 45);
            $table->string('nombre_raza', 45);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_de_mascotas');
    }
};
