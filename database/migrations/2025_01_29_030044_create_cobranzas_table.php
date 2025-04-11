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
        Schema::create('cobranzas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_boleta')->unique();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->decimal('monto_total', 10, 2)->comment('Monto total de todos los servicios cobrados');
            $table->decimal('monto_pago_efectivo', 10, 2);
            $table->decimal('monto_cambio_efectivo', 10, 2);
            $table->enum('tipo_pago', ['efectivo', 'deposito'])->default('efectivo');
            $table->date('fecha_cobro');
            $table->enum('estado_cobro', ['emitido', 'anulado'])->default('emitido');
            $table->text('glosa')->nullable()->comment('Notas o comentarios adicionales sobre el pago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobranzas');
    }
};