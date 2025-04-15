<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('database_backups', function (Blueprint $table) {
            if (!Schema::hasColumn('database_backups', 'nombre')) {
                $table->string('nombre')->after('id');
            }
            if (!Schema::hasColumn('database_backups', 'tamanio')) {
                $table->string('tamanio')->after('nombre');
            }
            if (!Schema::hasColumn('database_backups', 'estado')) {
                $table->enum('estado', ['Completado', 'Parcial', 'Error'])->after('tamanio');
            }
            if (!Schema::hasColumn('database_backups', 'archivo_path')) {
                $table->string('archivo_path')->after('estado');
            }
        });
    }

    public function down()
    {
        Schema::table('database_backups', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'tamanio', 'estado', 'archivo_path']);
        });
    }
}; 