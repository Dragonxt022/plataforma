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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_nota', 255);
            $table->string('link_arquivo', 255)->nullable();
            $table->date('data_vencimento');
            $table->unsignedBigInteger('id_notas_categoria');
            $table->timestamps();

            $table->foreign('id_notas_categoria')->references('id')->on('notas_categoria');
        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
