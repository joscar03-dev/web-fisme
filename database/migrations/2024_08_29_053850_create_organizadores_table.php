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
        Schema::create('organizadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique(); // Si el slug debe ser único
            $table->string('imagen')->nullable();
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->text('biografia_breve');
            $table->boolean('estado')->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizadores');
    }
};
