<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->string('tipo', 50)->nullable(); // Campo tipo (Preventa, Venta Normal, etc.)
            $table->string('modalidad', 50)->nullable(); // Modalidad de asistencia
            $table->string('entidad_financiera')->nullable(); // Entidad financiera
            $table->date('fecha_pago')->nullable(); // Fecha de pago
            $table->string('n_comprobante')->nullable(); // Número de comprobante
        });
    }

    public function down()
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'modalidad', 'entidad_financiera', 'fecha_pago', 'n_comprobante']);
        });
    }
};
