<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentos_inscripcions', function (Blueprint $table) {

            $table->id();
            $table->foreignId('inscripcion_concurso_id')
                ->constrained('inscripcion_concursos')
                ->onDelete('cascade');
            $table->foreignId('tipo_documento_id')
                ->constrained('tipo_documentos')
                ->onDelete('cascade');
                $table->string('ruta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_inscripcions');
    }
};
