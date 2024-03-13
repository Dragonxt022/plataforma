<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaPostTable extends Migration
{
    public function up()
    {
        Schema::create('categoria_post', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('slog');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoria_post');
    }
}
