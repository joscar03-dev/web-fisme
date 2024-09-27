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
        Schema::create('custom_role_custom_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_role_id')->constrained()->onDelete('cascade');
            $table->foreignId('custom_permission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_role_custom_permission');
    }
};
