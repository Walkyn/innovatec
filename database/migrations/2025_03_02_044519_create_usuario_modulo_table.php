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
        Schema::create('usuario_modulo', function (Blueprint $table) {
            // Claves foráneas
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_modulo');

            // Timestamps (opcional)
            $table->timestamps();

            // Definir claves foráneas
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_modulo')
                ->references('id_modulo')
                ->on('modulos')
                ->onDelete('cascade');
            $table->primary(['id_usuario', 'id_modulo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_modulo');
    }
};
