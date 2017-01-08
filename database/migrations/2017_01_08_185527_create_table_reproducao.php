<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReproducao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reprodutores', function (Blueprint $table) {
            $table->increments('id');  
            $table->integer('id_gaiola')->unsigned();
            $table->integer('id_reprodutor')->unsigned();
            $table->integer('id_matriz')->unsigned();
            $table->date('data_cobertura');
            $table->date('prev_parto');
            $table->string('rep_cio');
            $table->string('aborto');
            $table->string('data_parto');
            $table->timestamps();
        });

        Schema::table('reprodutores', function(Blueprint $table) {
            $table->foreign('id_gaiola')->references('id')->on('gaiolas')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('reprodutores', function(Blueprint $table) {
            $table->foreign('id_reprodutor')->references('id')->on('animais')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('reprodutores', function(Blueprint $table) {
            $table->foreign('id_matriz')->references('id')->on('animais')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reprodutores');
    }
}
