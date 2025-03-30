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
        Schema::create('contrato_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrato_id')->constrained('contratos')->onDelete('cascade');
            $table->foreignId('servicio_id')->nullable()->constrained('servicios')->onDelete('set null');
            $table->foreignId('plan_id')->nullable()->constrained('planes')->onDelete('set null');
            $table->string('ip_servicio', 20)->nullable();
            $table->timestamp('fecha_servicio')->useCurrent();
            $table->enum('estado_servicio_cliente', ['activo', 'suspendido']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato_servicio');
    }
};
