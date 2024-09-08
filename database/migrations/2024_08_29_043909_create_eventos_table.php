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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_evento');
            $table->string('slug');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->time('hora_inicio');
            $table->time('hora_salida')->nullable();
            $table->string('lugar');
            $table->string('tipo_evento');
            $table->string('area_evento')->nullable();
            $table->string('organizador');
            $table->text('descripcion_breve');
            $table->decimal('precio_inscripcion', 8, 2)->nullable();
            $table->string('imagen_banner')->nullable();
            $table->string('video_banner')->nullable();
            $table->string('enlace_inscripcion');
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
