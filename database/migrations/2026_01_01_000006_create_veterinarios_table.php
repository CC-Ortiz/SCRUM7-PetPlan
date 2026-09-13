<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->id('id_veterinario');
            $table->string('nombre_veterinario', 30);
            $table->string('apellido_veterinario', 30);
            $table->string('num_documento_vet', 15)->unique();
            $table->string('num_tarjeta_profesional', 45)->unique();
            $table->string('email_veterinario', 45)->unique();
            $table->string('num_contacto_veterinario', 45)->unique();

            // Campos de autenticación (el veterinario también inicia sesión en PetPlan)
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinarios');
    }
};
