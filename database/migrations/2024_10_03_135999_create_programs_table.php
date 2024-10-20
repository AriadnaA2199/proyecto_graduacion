<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->string('program_id')->primary();  // Clave primaria de tipo texto
            $table->string('name')->unique();  // Nombre del programa, único
            $table->text('description')->nullable();  // Descripción del programa
            $table->unsignedBigInteger('country_id');  // Relación con la tabla 'countries'
            $table->timestamps();

            // Definir la clave foránea hacia la tabla 'countries'
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
