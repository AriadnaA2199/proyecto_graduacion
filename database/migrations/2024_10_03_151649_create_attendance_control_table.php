<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_control', function (Blueprint $table) {
            $table->string('attendance_id')->primary();  // Clave primaria
            $table->string('training_id');  // Clave foránea hacia 'trainings'
            $table->string('recruit_id');  // Id del recluta (si tienes una tabla de reclutas)
            $table->date('date');  // Fecha de la asistencia
            $table->string('status');  // Estado de la asistencia (ej. Presente, Ausente)
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'trainings'
            $table->foreign('training_id')->references('training_id')->on('trainings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_control');
    }
};
