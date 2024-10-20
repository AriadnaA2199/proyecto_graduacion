<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roster', function (Blueprint $table) {
            $table->string('employee_id')->primary();  // Clave primaria
            $table->string('full_name')->nullable(false);  // Nombre completo del empleado
            $table->string('profile');  // Perfil del empleado (ej. Recluta, Administrador, etc.)
            $table->string('program');  // Clave foránea hacia 'programs'
            $table->date('hiring_date');  // Fecha de contratación
            $table->string('status');  // Estado del empleado
            $table->date('termination_date')->nullable();  // Fecha de deserción (si el estado es "Terminado")
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'programs'
            $table->foreign('program')->references('program_id')->on('programs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roster');
    }
};
