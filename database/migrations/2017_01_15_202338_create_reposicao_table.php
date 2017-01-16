<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReposicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reposicao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_maternidade');
            $table->integer('id_gaiola');
            $table->date('data_entrada');
            $table->integer('quantidade');
            $table->integer('dias_fase')->unsigned();
            $table->integer('peso')->unsigned();
            $table->date('prev_saida');
            $table->integer('prev_quantidade')->unsigned();
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
        Schema::dropIfExists('reposicao');
    }
}
