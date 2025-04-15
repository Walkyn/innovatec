<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('database_backups', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tamanio');
            $table->string('archivo_path');
            $table->enum('estado', ['Completado', 'Parcial', 'Error'])->default('Completado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('database_backups');
    }
}; 