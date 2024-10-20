<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recruits', function (Blueprint $table) {
            $table->string('recruit_id')->primary();  // Clave primaria de tipo texto
            $table->string('roster_id');  // Relación con la tabla 'roster' usando 'employee_id'
            $table->string('full_name');  // Nombre completo del recluta
            $table->string('training_id');  // Relación con la tabla 'trainings'
            $table->date('hiring_date');  // Fecha de contratación del recluta
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'roster' usando 'employee_id'
            $table->foreign('roster_id')->references('employee_id')->on('roster')->onDelete('cascade');

            // Definir la clave foránea hacia la tabla 'trainings'
            $table->foreign('training_id')->references('training_id')->on('trainings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruits');
    }
};
