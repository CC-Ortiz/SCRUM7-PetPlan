<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_de_documento', function (Blueprint $table) {
            $table->increments('id_tipo_documento');
            $table->string('nombre_tipo_documento', 45)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_de_documento');
    }
};
