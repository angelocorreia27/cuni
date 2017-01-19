<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngordaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('engorda', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_maternidade')->unsigned();
            $table->integer('id_gaiola')->unsigned();                     
            $table->integer('quantidade')->unsigned();
            $table->date('data_entrada');
            $table->integer('dias_fase')->unsigned();
            $table->date('prev_saida');
        });

        Schema::table('engorda', function(Blueprint $table) {
            $table->foreign('id_maternidade')->references('id')->on('maternidade');

        });

        Schema::table('engorda', function(Blueprint $table) {
            $table->foreign('id_gaiola')->references('id')->on('gaiolas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
