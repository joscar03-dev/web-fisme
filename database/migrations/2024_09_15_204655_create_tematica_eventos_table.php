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
        Schema::create('tematica_eventos', function (Blueprint $table) {

            $table->id();
            $table->foreignId('evento_id')
                ->constrained('eventos')
                ->onDelete('cascade'); // Elimina la relación, pero deja al organizador intacto

            // No elimines el organizador si un evento se elimina
            $table->foreignId('tematica_id')
                ->constrained('tematicas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tematica_eventos');
    }
};
