<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescontosAutomaticosTable extends Migration
{
    public function up()
    {
        Schema::create('descontos_automaticos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_1', 8, 2);
            $table->decimal('valor_2', 8, 2);
            $table->decimal('valor_3', 8, 2);
            $table->decimal('valor_4', 8, 2);
            $table->decimal('valor_5', 8, 2);
            $table->decimal('mais_de_5', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('descontos_automaticos');
    }
}
