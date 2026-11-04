<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla de equipos tecnológicos.
     */
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->string('nombre', 100);
            $table->string('marca', 60);
            $table->string('modelo', 60);
            $table->string('numero_serie', 80)->unique();
            $table->enum('estado', ['disponible', 'asignado', 'mantenimiento'])->default('disponible');
            $table->date('fecha_adquisicion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
