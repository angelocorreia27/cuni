<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnimaisAddColumnIdBanda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    

            Schema::table('animais', function ($table) {
                    $table->integer('id_banda')->unsigned();

                    $table->foreign('id_banda')->references('id')->on('dominio');
                    }
            );


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
