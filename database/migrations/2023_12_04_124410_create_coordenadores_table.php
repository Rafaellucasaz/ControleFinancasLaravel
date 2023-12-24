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
        Schema::create('coordenadores', function (Blueprint $table) {
            $table->bigInteger('id_logfk')->references('id_log')->on('logins');
            $table->bigInteger('id_progfk')->references('id_prog')->on('programas');
            $table->timestamps();
            $table->string('nome', 100);
            $table->primary(['id_logfk','id_progfk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordenadores');
    }
};
