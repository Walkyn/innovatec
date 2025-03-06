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
        Schema::create('info_ticket', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('eslogan_empresa')->nullable();
            $table->string('ruc')->unique();
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable();
            $table->text('agradecimiento')->nullable();
            $table->string('sitio_web')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_ticket');
    }
};
