<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id('id_mascota');
            $table->string('nombre_mascota', 45);
            $table->string('edad_mascota', 45);
            $table->string('peso_mascota', 45);
            $table->string('color_mascota', 45)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->text('observaciones')->nullable();

            $table->foreignId('id_tipo_mascota')
                ->constrained('tipos_de_mascotas', 'id_tipo_mascota')
                ->cascadeOnUpdate();

            // Relación mascota -> dueño: la llave foránea vive en "mascotas",
            // un dueño puede tener muchas mascotas.
            $table->foreignId('id_dueno')
                ->constrained('duenos', 'id_dueno')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
