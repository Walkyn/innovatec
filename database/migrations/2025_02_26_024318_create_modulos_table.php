<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id('id_modulo');
            $table->string('nombre_modulo', 50)->unique();
            $table->timestamps();
        });
    
        DB::table('modulos')->insert([
            ['id_modulo' => 1, 'nombre_modulo' => 'home'], // Inicio
            ['id_modulo' => 2, 'nombre_modulo' => 'clients'], // Clientes
            ['id_modulo' => 3, 'nombre_modulo' => 'manage'], // Administrar
            ['id_modulo' => 4, 'nombre_modulo' => 'payments'], // Cobranzas
            ['id_modulo' => 5, 'nombre_modulo' => 'calendar'], // Calendario
            ['id_modulo' => 6, 'nombre_modulo' => 'profile'], // Perfil
            ['id_modulo' => 7, 'nombre_modulo' => 'settings'], // Configuración
            ['id_modulo' => 8, 'nombre_modulo' => 'reports'], // Reportes
            ['id_modulo' => 9, 'nombre_modulo' => 'database'], // Database
            ['id_modulo' => 10, 'nombre_modulo' => 'users'], // Users
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
