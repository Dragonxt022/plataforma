<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inscricao_id');
            $table->string('nome');
            $table->string('celular');
            $table->string('email');
            $table->unsignedBigInteger('id_treinamento');
            $table->timestamps();

            $table->foreign('inscricao_id')->references('id')->on('inscricoes')->onDelete('cascade');
            $table->foreign('id_treinamento')->references('id')->on('treinamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('participantes');
    }

};
