<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('duenos', function (Blueprint $table) {
            $table->id('id_dueno');
            $table->string('num_contacto', 15)->unique();
            $table->string('email', 50)->unique();
            $table->string('nombre', 60);
            $table->string('apellido', 45);
            $table->string('num_documento', 15)->unique();
            $table->foreignId('tipo_documento_id')
                ->nullable()
                ->constrained('tipos_de_documento', 'id_tipo_documento')
                ->nullOnDelete();
            // Campos de autenticación (el dueño es quien inicia sesión en PetPlan)
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('duenos');
    }
};
