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
        Schema::create('evento_has_patrocinadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')
                ->constrained('eventos')
                ->onDelete('cascade'); // Elimina la relación, pero deja al patrocinador intacto

            // No elimines el patrocinador si un evento se elimina
            $table->foreignId('patrocinador_id')
                ->constrained('patrocinadores')
                ->onDelete('restrict'); // El patrocinador permanece intacto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_has_patrocinadores');
    }
};
