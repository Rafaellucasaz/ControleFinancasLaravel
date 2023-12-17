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
        Schema::create('programas', function (Blueprint $table) {
            $table->id('id_prog');
            $table->timestamps();
            $table->string('nom_prog',20);
            $table->string('tipo_prog',9);
            $table->integer('dia_civ');
            $table->integer('dia_int');
            $table->integer('pass');
            $table->integer('sepe');
            $table->integer('nao_serv');
            $table->integer('aux_est');
            $table->integer('aux_pes');
            $table->integer('cons');
            $table->integer('ser_ter');
            $table->integer('tran');
            $table->integer('total');
            $table->boolean('edit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
