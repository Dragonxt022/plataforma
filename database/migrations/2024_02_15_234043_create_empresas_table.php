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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj', 18);
            $table->string('endereco');
            $table->integer('numero');
            $table->string('bairro');
            $table->string('cep', 10);
            $table->string('banco');
            $table->string('conta');
            $table->string('beneficiario');
            $table->text('cabecalho')->nullable();
            $table->text('rodape')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
    
};
