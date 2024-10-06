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
        Schema::create('inscripcion_concursos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 255);           
            $table->string('numero_documento', 15);
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('numero_celular', 20)->nullable();
            $table->string('tipo_participante', 255)->nullable();
            $table->string('institucion_procedencia', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('img_boucher')->nullable();
            $table->foreignId('concurso_id')->constrained('concursos');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('verificado')->default(false);
            $table->foreignId('usuario_verificacion')->nullable()->constrained('users');
            $table->timestamp('fecha_verificacion')->useCurrent();         
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_concursos');
    }
};
