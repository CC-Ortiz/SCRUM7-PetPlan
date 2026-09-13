<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_citas');
            $table->dateTime('fecha_cita');
            $table->string('categoria', 45)->default('Consulta General');
            $table->text('descripcion');
            $table->boolean('confirmacion')->default(false);

            // La cita se agenda directamente para una mascota; como la mascota
            // ya conoce a su dueño, no hace falta repetir el dato del dueño aquí.
            $table->foreignId('id_mascota')
                ->constrained('mascotas', 'id_mascota')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
