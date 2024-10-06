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
        Schema::create('precio_concursos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_participante',255)->nullable();
            $table->decimal('precio',10,2)->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('consurso_id')->constrained('consursos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precio_concursos');
    }
};
