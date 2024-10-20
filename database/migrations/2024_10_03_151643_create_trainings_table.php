<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->string('training_id')->primary();  // Clave primaria
            $table->date('start_training_date');  // Fecha de inicio de la capacitación
            $table->date('end_training_date');  // Fecha de fin de la capacitación
            $table->date('start_transition_date');  // Fecha de inicio de transición
            $table->date('end_transition_date');  // Fecha de fin de transición
            $table->date('start_production_date');  // Fecha de inicio en producción
            $table->string('program');  // Clave foránea hacia 'programs'
            $table->string('trainer_name');  // Nombre del entrenador
            $table->string('class_type');  // Tipo de clase (ej. Virtual, Presencial)
            $table->unsignedBigInteger('department_id')->nullable();  // ID del departamento (si tienes una tabla de departamentos)
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'programs'
            $table->foreign('program')->references('program_id')->on('programs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
