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
        Schema::create('ponentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique(); // Si el slug debe ser único
            $table->string('apellidos');
            $table->string('especialidad');
            $table->string('imagen')->nullable();
            $table->string('institucion');
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->string('logo_pais')->nullable();
            $table->string('logo_instituccion')->nullable();
            $table->text('biografia_breve');
            $table->unsignedBigInteger('tema_id');
            $table->boolean('estado')->default(true);
           
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ponentes');
    }
};
