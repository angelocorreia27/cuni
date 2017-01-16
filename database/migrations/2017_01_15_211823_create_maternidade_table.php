<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaternidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maternidade', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_reproducao');
            $table->integer('id_gaiola');
            $table->date('data_parto');
            $table->integer('vivos')->unsigned();
            $table->integer('n_m')->unsigned();
            $table->integer('peso_ninhada')->unsigned();
            $table->integer('peso_desmame')->unsigned();
            $table->integer('a_desmamar')->unsigned();
            $table->date('prev_desmame');
            $table->date('prev_cobertura');
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
        Schema::dropIfExists('maternidade');
    }
}
