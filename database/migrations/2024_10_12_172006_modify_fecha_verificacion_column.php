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
        Schema::table('inscripcion_concursos', function (Blueprint $table) {
            $table->datetime('fecha_verificacion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_concursos', function (Blueprint $table) {
            $table->timestamp('fecha_verificacion')->useCurrent()->change(); // Opción anterior
        });
    }
};
