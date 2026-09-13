<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historia_veterinario', function (Blueprint $table) {
            $table->foreignId('id_historia_clinica')
                ->constrained('historias_clinicas', 'id_historia_clinica')
                ->cascadeOnDelete();
            $table->foreignId('id_veterinario')
                ->constrained('veterinarios', 'id_veterinario')
                ->cascadeOnDelete();
            $table->primary(['id_historia_clinica', 'id_veterinario']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historia_veterinario');
    }
};
