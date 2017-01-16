<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMaternidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('maternidade', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_reproducao')->unsigned();
            $table->integer('id_gaiola')->unsigned();
            $table->date('data_parto');
            $table->integer('n_vivos')->unsigned();
            $table->integer('n_mortos')->unsigned();
            $table->integer('peso_ninhada')->unsigned();
            $table->integer('peso_desmame')->unsigned();
            $table->date('data_prev_desmame');
            $table->date('data_desmame');
            $table->date('data_prev_cobertura');
        });

        Schema::table('maternidade', function(Blueprint $table) {
            $table->foreign('id_gaiola')->references('id')->on('gaiolas')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('maternidade', function(Blueprint $table) {
            $table->foreign('id_reproducao')->references('id')->on('reproducao')
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
        //
    }
}
