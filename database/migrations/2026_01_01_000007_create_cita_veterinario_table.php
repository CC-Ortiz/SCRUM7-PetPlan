<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cita_veterinario', function (Blueprint $table) {
            $table->foreignId('id_citas')
                ->constrained('citas', 'id_citas')
                ->cascadeOnDelete();
            $table->foreignId('id_veterinario')
                ->constrained('veterinarios', 'id_veterinario')
                ->cascadeOnDelete();
            $table->primary(['id_citas', 'id_veterinario']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cita_veterinario');
    }
};
