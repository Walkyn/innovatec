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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('identificacion')->unique();
            $table->string('clave_acceso')->nullable();
            $table->string('telefono');
            $table->text('direccion');
            $table->string('gps')->nullable();
            $table->foreignId('region_id')->nullable()->constrained('regiones')->onDelete('set null');
            $table->foreignId('provincia_id')->nullable()->constrained('provincias')->onDelete('set null');
            $table->foreignId('distrito_id')->nullable()->constrained('distritos')->onDelete('set null');
            $table->foreignId('pueblo_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('estado_cliente', ['activo', 'inactivo', 'suspendido']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
