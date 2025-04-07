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
        Schema::create('configuracion_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('ruc', 20)->nullable();
            $table->string('correo', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('logo')->nullable();
            $table->string('portada')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });

        // Insertar datos por defecto
        DB::table('configuracion_empresa')->insert([
            'nombre' => 'Business Manager',
            'ruc' => '20' . rand(10000000, 99999999) . '0' . rand(0, 9),
            'correo' => 'info@businessmanager.com',
            'telefono' => '9' . rand(1000000, 9999999),
            'direccion' => 'Av. Principal ' . rand(1, 1000) . ', Lima',
            'descripcion' => 'Sistema de gestión empresarial para pequeñas y medianas empresas',
            'facebook' => 'https://facebook.com/businessmanager',
            'instagram' => 'https://instagram.com/businessmanager',
            'linkedin' => 'https://linkedin.com/company/businessmanager',
            'website' => 'https://businessmanager.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion_empresa');
    }
};
