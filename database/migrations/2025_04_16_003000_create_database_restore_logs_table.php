<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('database_restore_logs', function (Blueprint $table) {
            $table->id();
            $table->string('archivo_nombre');
            $table->string('host');
            $table->string('database');
            $table->string('username');
            $table->boolean('success');
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('database_restore_logs');
    }
}; 