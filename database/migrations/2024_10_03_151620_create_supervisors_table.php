<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->string('supervisor_id')->primary();  // Clave primaria de tipo texto
            $table->string('name')->nullable(false);  // Nombre del supervisor
            $table->string('roster_id');  // Relación con la tabla 'roster' a través de 'employee_id'
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'roster' usando 'employee_id' como la columna de referencia
            $table->foreign('roster_id')->references('employee_id')->on('roster')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
