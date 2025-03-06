<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_rol');
            $table->string('nombre_rol', 50)->unique();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['id_rol' => 1, 'nombre_rol' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['id_rol' => 2, 'nombre_rol' => 'Empleado', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
