<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->string('trainer_id')->primary();  // Clave primaria
            $table->string('name')->nullable(false);  // Nombre del entrenador
            $table->string('program');  // Clave foránea hacia 'programs'
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'programs'
            $table->foreign('program')->references('program_id')->on('programs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
