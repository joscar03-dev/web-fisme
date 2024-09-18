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
        Schema::create('lugar_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombrelugar');
            $table->string('lema-ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('url_mapa')->nullable();
            $table->string('img')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugar_eventos');
    }
};
