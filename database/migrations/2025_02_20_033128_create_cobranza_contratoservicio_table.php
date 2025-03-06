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
        Schema::create('cobranza_contratoservicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cobranza_id')->constrained('cobranzas')->onDelete('cascade');
            $table->foreignId('contrato_servicio_id')->constrained('contrato_servicio')->onDelete('cascade');
            $table->foreignId('mes_id')->constrained('meses')->onDelete('cascade');
            $table->decimal('monto_pagado', 10, 2);
            $table->enum('estado_pago', ['pendiente', 'pagado', 'anulado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobranza_contratoservicio');
    }
};
