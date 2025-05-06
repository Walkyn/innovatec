<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos_soporte', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->enum('estado', ['pendiente', 'visitar', 'solucionado', 'cobrar']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('cliente_nombre')->nullable();
            $table->foreignId('tecnico_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('todo_dia')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos_soporte');
    }
};
