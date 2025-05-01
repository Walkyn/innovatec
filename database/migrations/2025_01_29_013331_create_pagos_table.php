<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('medio_pago');
            $table->text('detalles_servicio');
            $table->text('meses_pagados');
            $table->decimal('monto_total', 10, 2);
            $table->string('comprobante_path')->nullable();
            $table->enum('estado', ['en_revision', 'Aprobado', 'Rechazado'])->default('en_revision');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
} 