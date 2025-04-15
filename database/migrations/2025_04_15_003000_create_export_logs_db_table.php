<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('export_logs_db', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('database');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('export_logs_db');
    }
}; 