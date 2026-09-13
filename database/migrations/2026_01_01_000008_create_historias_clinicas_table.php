<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historias_clinicas', function (Blueprint $table) {
            $table->id('id_historia_clinica');

            $table->foreignId('id_mascota')
                ->constrained('mascotas', 'id_mascota')
                ->cascadeOnDelete();

            $table->string('diagnostico', 255)->nullable();
            $table->string('tratamiento', 255)->nullable();
            $table->string('vacuna_recomendada', 100)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->text('historia_clinica');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historias_clinicas');
    }
};
