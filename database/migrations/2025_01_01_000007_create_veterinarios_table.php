<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veterinarios', function (Blueprint $table) {
            $table->increments('id_veterinario');
            $table->string('nombre_veterinario', 30);
            $table->string('apellido_veterinario', 30);
            $table->string('num_documento_vet', 15)->unique();
            $table->string('num_tarjetaprofesional', 45)->unique();
            $table->string('email_veterinario', 45)->unique();
            $table->string('num_contacto_veterinario', 45)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinarios');
    }
};
