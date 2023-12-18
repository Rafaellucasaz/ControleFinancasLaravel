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
            $table->biginteger('dia_civ');
            $table->biginteger('dia_int');
            $table->biginteger('pass');
            $table->biginteger('sepe');
            $table->biginteger('nao_serv');
            $table->biginteger('aux_estu');
            $table->biginteger('aux_pesq');
            $table->biginteger('cons');
            $table->biginteger('ser_ter');
            $table->biginteger('tran');
            $table->biginteger('total');
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
