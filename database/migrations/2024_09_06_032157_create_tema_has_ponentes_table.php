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
        Schema::create('tema_has_ponentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tema_id')->constrained('temas')->onDelete('cascade');
            $table->foreignId('ponente_id')->constrained('ponentes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema_has_ponentes');
    }
};
