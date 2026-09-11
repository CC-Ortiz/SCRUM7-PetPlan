<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id_citas');
            $table->dateTime('fecha_cita');
            $table->text('descripcion');
            $table->tinyInteger('confirmacion')->nullable()->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
