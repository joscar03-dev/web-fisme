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
        Schema::create('resgistros', function (Blueprint $table) {
            $table->id();
            //tipo de documento
            $table->string('tipo_documento', 20);
            $table->string('numero_documento', 15);
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('numero_celular', 20);
            $table->string('tipo_asistente', 20);
            $table->string('institucion_procedencia', 20);
            $table->string('email');
            $table->string('img_boucher');
            $table->foreignId('evento_id')->constrained('eventos');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->boolean('verificado')->default(false);
            //usuario de verificacion
            //fecha de verficacion timestamps
            
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resgistros');
    }
};
