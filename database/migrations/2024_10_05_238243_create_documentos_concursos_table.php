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
        Schema::create('documentos_concursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concurso_id')
                ->constrained('concursos')
                ->onDelete('cascade');
            $table->foreignId('tipo_documento_id')
                ->constrained('tipo_documentos')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_concursos');
    }
};
