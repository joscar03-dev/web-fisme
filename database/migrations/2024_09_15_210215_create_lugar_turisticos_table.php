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
        Schema::create('lugar_turisticos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_lugar');
            $table->string('descripcion-corta')->nullable();
            $table->string('direccion')->nullable();
            $table->string('url_mapa')->nullable();
            $table->string('img')->nullable();
            $table->boolean('estado')->default(true);
               $table->foreignId('lugar_evento_id')
               ->constrained('lugar_eventos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugar_turisticos');
    }
};
