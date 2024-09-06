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
        Schema::table('resgistros', function (Blueprint $table) {
            $table->foreignId('usuario_verificacion')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamp('fecha_verificacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resgistros', function (Blueprint $table) {
            $table->dropForeign(['usuario_verificacion']);
            $table->dropColumn('usuario_verificacion');
            $table->dropColumn('fecha_verificacion');
        });
    }
};
