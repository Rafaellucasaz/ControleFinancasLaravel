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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_ped');
            $table->bigInteger('id_progfk')->references('id_prog')->on('programas');
            $table->timestamps();
            $table->integer('num_ped');
            $table->string('tipo_ped');
            $table->date('data');
            $table->integer('val');
            $table->text('det');
            $table->string('ben',100);
            $table->string('pcdp',9);
            $table->text('prest');
            $table->unique(['id_progfk','num_ped','tipo_ped']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
