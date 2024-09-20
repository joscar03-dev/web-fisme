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
        Schema::create('precio_beneficios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('precio_id')
                ->constrained('precios')
                ->onDelete('cascade');
            $table->foreignId('beneficio_id')
                ->constrained('beneficios')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precio_beneficios');
    }
};
