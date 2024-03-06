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
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->string('quantidade_inscritos');
            $table->decimal('valor_curso', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('desconto', 10, 2);
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('id_empresa');
            $table->string('pdf_caminho')->nullable();
            $table->string('nome_treinamento');
            $table->unsignedBigInteger('id_treinamento');
            $table->string('nome_empresa');
            $table->date('data_inicio');
            $table->string('nome_juridico');
            $table->string('cnpj');
            $table->string('cep');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero');
            $table->string('responsavel');
            $table->string('telefone');
            $table->string('email');
            $table->date('data_realizacao');
            $table->enum('status', ['Processando', 'Pago', 'Cancelado'])->default('Processando');
            $table->date('data_termino');
            $table->timestamps();

            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->foreign('id_treinamento')->references('id')->on('treinamentos');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
