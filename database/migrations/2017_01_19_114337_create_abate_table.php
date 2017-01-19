<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('abate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_engorda')->unsigned();
            $table->integer('id_gaiola')->unsigned();
            $table->integer('id_animal')->unsigned();
            $table->date('data_abate');
            $table->integer('peso')->unsigned();      
            $table->timestamps();
            $table->softDeletes();
        });

          Schema::table('abate', function(Blueprint $table) {
            $table->foreign('id_engorda')->references('id')->on('engorda');

        });

          Schema::table('abate', function(Blueprint $table) {
            $table->foreign('id_gaiola')->references('id')->on('gaiolas');

        });

          Schema::table('abate', function(Blueprint $table) {
            $table->foreign('id_animal')->references('id')->on('animal');

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
