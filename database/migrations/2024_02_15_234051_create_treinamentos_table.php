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
        Schema::create('treinamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->decimal('valor', 8, 2);
            $table->integer('vagas');
            $table->string('local');
            $table->foreignId('id_empresa')->constrained('empresas');
            $table->string('banner')->nullable();
            $table->string('docente');
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
        Schema::dropIfExists('treinamentos');
    }
};
